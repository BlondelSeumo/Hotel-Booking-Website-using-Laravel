<?php

namespace Botble\Hotel\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Hotel\Enums\BookingStatusEnum;
use Botble\Hotel\Enums\ReviewStatusEnum;
use Botble\Hotel\Enums\ServicePriceTypeEnum;
use Botble\Hotel\Facades\HotelHelper;
use Botble\Hotel\Http\Requests\CalculateBookingAmountRequest;
use Botble\Hotel\Http\Requests\CheckoutRequest;
use Botble\Hotel\Http\Requests\InitBookingRequest;
use Botble\Hotel\Models\Booking;
use Botble\Hotel\Models\BookingAddress;
use Botble\Hotel\Models\BookingRoom;
use Botble\Hotel\Models\Currency;
use Botble\Hotel\Models\Customer;
use Botble\Hotel\Models\Place;
use Botble\Hotel\Models\Room;
use Botble\Hotel\Models\Service;
use Botble\Hotel\Repositories\Interfaces\RoomInterface;
use Botble\Hotel\Services\BookingService;
use Botble\Hotel\Services\CouponService;
use Botble\Media\Facades\RvMedia;
use Botble\Optimize\Facades\OptimizerHelper;
use Botble\Payment\Enums\PaymentMethodEnum;
use Botble\Payment\Services\Gateways\BankTransferPaymentService;
use Botble\Payment\Services\Gateways\CodPaymentService;
use Botble\Payment\Supports\PaymentHelper;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Slug\Facades\SlugHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function getRooms(Request $request, RoomInterface $roomRepository, BaseHttpResponse $response)
    {
        SeoHelper::setTitle(__('Rooms'));

        Theme::breadcrumb()->add(__('Rooms'), route('public.rooms'));

        $requestQuery = HotelHelper::getRoomFilters($request);

        if ($request->ajax() && $request->wantsJson()) {
            [$startDate, $endDate, $adults, $children, $rooms] = HotelHelper::getRoomBookingParams();

            $condition = [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'adults' => $adults,
                'children' => $children,
                'rooms' => $rooms,
            ];

            $filters = [
                'keyword' => $requestQuery['keyword'],
            ];

            $params = [
                'paginate' => [
                    'per_page' => $requestQuery['per_page'],
                    'current_paged' => $requestQuery['page'],
                ],
                'with' => [
                    'amenities',
                    'amenities.metadata',
                    'slugable',
                    'activeBookingRooms' => function ($query) use ($startDate, $endDate) {
                        return $query
                            ->whereNot('status', BookingStatusEnum::CANCELLED)
                            ->where(function ($query) use ($endDate, $startDate) {
                                return $query
                                    ->where(function ($query) use ($startDate, $endDate) {
                                        return $query
                                            ->whereDate('start_date', '>=', $startDate)
                                            ->whereDate('start_date', '<=', $endDate);
                                    })
                                    ->orWhere(function ($query) use ($startDate, $endDate) {
                                        return $query
                                            ->whereDate('end_date', '>=', $startDate)
                                            ->whereDate('end_date', '<=', $endDate);
                                    })
                                    ->orWhere(function ($query) use ($startDate, $endDate) {
                                        return $query
                                            ->whereDate('start_date', '<=', $startDate)
                                            ->whereDate('end_date', '>=', $endDate);
                                    })
                                    ->orWhere(function ($query) use ($startDate, $endDate) {
                                        return $query
                                            ->whereDate('start_date', '>=', $startDate)
                                            ->whereDate('end_date', '<=', $endDate);
                                    });
                            });
                    },
                    'activeRoomDates' => function ($query) use ($startDate, $endDate) {
                        return $query
                            ->whereDate('start_date', '>=', $startDate)
                            ->whereDate('end_date', '<=', $endDate)
                            ->take(42);
                    },
                ],
            ];

            $allRooms = $roomRepository->getRooms($filters, $params);

            $rooms = [];
            foreach ($allRooms as $allRoom) {
                if ($allRoom->isAvailableAt($condition)) {
                    $allRoom->total_price = $allRoom->getRoomTotalPrice($startDate, $endDate);
                    $rooms[] = $allRoom;
                }
            }

            $data = null;

            foreach ($rooms as $room) {
                $data = view(
                    Theme::getThemeNamespace('views.hotel.includes.room-item'),
                    compact('room')
                )->render();
            }

            return $response->setData($data);
        }

        return Theme::scope('hotel.rooms')->render();
    }

    public function getRoom(string $key, RoomInterface $roomRepository)
    {
        $slug = SlugHelper::getSlug($key, SlugHelper::getPrefix(Room::class));

        if (! $slug) {
            abort(404);
        }

        [$startDate, $endDate, $adults] = HotelHelper::getRoomBookingParams();

        $room = Room::query()
            ->with([
                'amenities',
                'currency',
                'category',
                'activeRoomDates' => function ($query) use ($startDate, $endDate) {
                    return $query
                        ->whereDate('start_date', '>=', $startDate)
                        ->whereDate('end_date', '<=', $endDate)
                        ->take(42);
                },
            ])
            ->withCount([
                'reviews',
                'reviews as approved_review_count' => function (Builder $query) {
                    $query->where('status', ReviewStatusEnum::APPROVED);
                },
            ])
            ->withAvg('reviews', 'star')
            ->findOrFail($slug->reference_id);

        SeoHelper::setTitle($room->name)->setDescription(Str::words($room->description, 120));

        $meta = new SeoOpenGraph();
        if ($room->image) {
            $meta->setImage(RvMedia::getImageUrl($room->image));
        }
        $meta->setDescription($room->description);
        $meta->setUrl($room->url);
        $meta->setTitle($room->name);
        $meta->setType('article');

        SeoHelper::setSeoOpenGraph($meta);

        Theme::breadcrumb()
            ->add($room->name, $room->url);

        if (function_exists('admin_bar')) {
            admin_bar()->registerLink(__('Edit this room'), route('room.edit', $room->getKey()));
        }

        $condition = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'adults' => $adults,
        ];

        $relatedRooms = $roomRepository->getRelatedRooms(
            $room->getKey(),
            (int) theme_option('number_of_related_rooms', 2),
            [
                'with' => [
                    'amenities',
                    'slugable',
                    'activeBookingRooms' => function ($query) use ($startDate, $endDate) {
                        return $query
                            ->whereNot('status', BookingStatusEnum::CANCELLED)
                            ->where(function ($query) use ($endDate, $startDate) {
                                return $query
                                    ->whereDate('start_date', '<=', $startDate)
                                    ->whereDate('end_date', '>=', $endDate);
                            });
                    },
                    'activeRoomDates' => function ($query) use ($startDate, $endDate) {
                        return $query
                            ->whereDate('start_date', '>=', $startDate)
                            ->whereDate('end_date', '<=', $endDate)
                            ->take(42);
                    },
                ],
            ]
        );

        foreach ($relatedRooms as &$relatedRoom) {
            if ($relatedRoom->isAvailableAt($condition)) {
                $relatedRoom->total_price = $relatedRoom->getRoomTotalPrice($startDate, $endDate);
            }
        }

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, ROOM_MODULE_SCREEN_NAME, $room);

        $images = [];
        foreach ($room->images as $image) {
            $images[] = RvMedia::getImageUrl($image, null, false, RvMedia::getDefaultImage());
        }

        $room->total_price = $room->getRoomTotalPrice($startDate, $endDate);

        Theme::asset()->add('ckeditor-content-styles', 'vendor/core/core/base/libraries/ckeditor/content-styles.css');

        $room->content = Html::tag('div', (string) $room->content, ['class' => 'ck-content'])->toHtml();

        return Theme::scope('hotel.room', compact('room', 'images', 'relatedRooms', 'startDate', 'endDate', 'adults'))->render();
    }

    public function getPlace(string $key)
    {
        $slug = SlugHelper::getSlug($key, SlugHelper::getPrefix(Place::class));

        if (! $slug) {
            abort(404);
        }

        $place = Place::query()
            ->with(['slugable'])
            ->findOrFail($slug->reference_id);

        SeoHelper::setTitle($place->name)->setDescription(Str::words($place->description, 120));

        $meta = new SeoOpenGraph();
        if ($place->image) {
            $meta->setImage(RvMedia::getImageUrl($place->image));
        }
        $meta->setDescription($place->description);
        $meta->setUrl($place->url);
        $meta->setTitle($place->name);
        $meta->setType('article');

        SeoHelper::setSeoOpenGraph($meta);

        Theme::breadcrumb()
            ->add($place->name, $place->url);

        $relatedPlaces = Place::query()
            ->wherePublished()
            ->whereNot('id', $place->getKey())
            ->limit(3)
            ->get();

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, PLACE_MODULE_SCREEN_NAME, $place);

        Theme::asset()->add('ckeditor-content-styles', 'vendor/core/core/base/libraries/ckeditor/content-styles.css');

        $place->content = Html::tag('div', (string) $place->content, ['class' => 'ck-content'])->toHtml();

        return Theme::scope('hotel.place', compact('place', 'relatedPlaces'))->render();
    }

    public function postBooking(InitBookingRequest $request, BaseHttpResponse $response)
    {
        abort_if(! HotelHelper::isBookingEnabled(), 404);

        $room = Room::query()
            ->with(['currency', 'category'])
            ->findOrFail($request->input('room_id'));

        $condition = [
            'start_date' => HotelHelper::dateFromRequest($request->input('start_date')),
            'end_date' => HotelHelper::dateFromRequest($request->input('end_date')),
            'adults' => $request->integer('adults', 1),
            'children' => $request->integer('children'),
            'rooms' => $request->integer('rooms', 1),
        ];

        if (! $room->isAvailableAt($condition)) {
            return $response
                ->setError()
                ->setMessage(__(
                    'This room is not available for booking from :start_date to :end_date!',
                    ['start_date' => $condition['start_date']->toDateString(), 'end_date' => $condition['end_date']->toDateString()]
                ))
                ->withInput();
        }

        $token = md5(Str::random(40));

        session([
            $token => $request->except(['_token']),
            'checkout_token' => $token,
        ]);

        return $response->setNextUrl(route('public.booking.form', $token));
    }

    public function getBooking(string $token, BaseHttpResponse $response)
    {
        abort_if(! HotelHelper::isBookingEnabled(), 404);

        SeoHelper::setTitle(__('Booking'));

        OptimizerHelper::disable();

        $customer = new Customer();

        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
        }

        $sessionData = [];
        if (session()->has($token)) {
            $sessionData = session($token);
        }

        if (empty($sessionData)) {
            abort(404);
        }

        Theme::breadcrumb()
            ->add(__('Booking'), route('public.booking'));

        $startDate = HotelHelper::dateFromRequest(Arr::get($sessionData, 'start_date'));
        $endDate = HotelHelper::dateFromRequest(Arr::get($sessionData, 'end_date'));
        $adults = Arr::get($sessionData, 'adults');
        $children = Arr::get($sessionData, 'children');
        $rooms = Arr::get($sessionData, 'rooms', 1);

        $room = Room::query()
            ->with([
                'currency',
                'category',
                'activeBookingRooms' => function ($query) use ($startDate, $endDate) {
                    return $query
                        ->whereNot('status', BookingStatusEnum::CANCELLED)
                        ->where(function ($query) use ($endDate, $startDate) {
                            return $query
                                ->where(function ($query) use ($startDate, $endDate) {
                                    return $query
                                        ->whereDate('start_date', '>=', $startDate)
                                        ->whereDate('start_date', '<=', $endDate);
                                })
                                ->orWhere(function ($query) use ($startDate, $endDate) {
                                    return $query
                                        ->whereDate('end_date', '>=', $startDate)
                                        ->whereDate('end_date', '<=', $endDate);
                                })
                                ->orWhere(function ($query) use ($startDate, $endDate) {
                                    return $query
                                        ->whereDate('start_date', '<=', $startDate)
                                        ->whereDate('end_date', '>=', $endDate);
                                })
                                ->orWhere(function ($query) use ($startDate, $endDate) {
                                    return $query
                                        ->whereDate('start_date', '>=', $startDate)
                                        ->whereDate('end_date', '<=', $endDate);
                                });
                        });
                },
                'activeRoomDates' => function ($query) use ($startDate, $endDate) {
                    return $query
                        ->whereDate('start_date', '>=', $startDate)
                        ->whereDate('end_date', '<=', $endDate)
                        ->take(42);
                },
            ])
            ->findOrFail(Arr::get($sessionData, 'room_id'));

        if (! $room->isAvailableAt(['start_date' => $startDate, 'end_date' => $endDate])) {
            return $response
                ->setError()
                ->setMessage(__(
                    'This room is not available for booking from :start_date to :end_date!',
                    ['start_date' => $startDate->toDateString(), 'end_date' => $endDate->toDateString()]
                ))
                ->withInput();
        }

        $room->total_price = $room->getRoomTotalPrice($startDate, $endDate, $rooms);

        $amount = $room->total_price + Arr::get($sessionData, 'service_amount', 0);

        $taxAmount = $room->tax->percentage * $amount / 100;

        $couponAmount = Arr::get($sessionData, 'coupon_amount', 0);

        $couponCode = Arr::get($sessionData, 'coupon_code');

        $total = $amount + $taxAmount - $couponAmount;

        $services = Service::query()
            ->wherePublished()
            ->get();

        $selectedServices = Arr::get($sessionData, 'selected_services', []);

        return Theme::scope(
            'hotel.booking',
            compact(
                'room',
                'services',
                'startDate',
                'endDate',
                'adults',
                'children',
                'rooms',
                'amount',
                'total',
                'taxAmount',
                'token',
                'customer',
                'selectedServices',
                'couponCode',
                'couponAmount',
            )
        )->render();
    }

    public function postCheckout(
        CheckoutRequest $request,
        BookingService $bookingService,
        BaseHttpResponse $response
    ) {
        do_action('form_extra_fields_validate', $request);

        $token = $request->input('token');

        if (! session()->has($token)) {
            if (session()->has('booking_transaction_id')) {
                return $response->setNextUrl(route('public.booking.information', session('booking_transaction_id')));
            }

            abort(404);
        }

        $room = Room::query()->findOrFail($request->input('room_id'));

        if ($request->input('register_customer') == 1) {
            $request->validate([
                'email' => 'required|max:60|min:6|email|unique:ht_customers,email',
            ]);

            $customer = Customer::query()->create([
                'first_name' => BaseHelper::clean($request->input('first_name')),
                'last_name' => BaseHelper::clean($request->input('last_name')),
                'email' => BaseHelper::clean($request->input('email')),
                'phone' => BaseHelper::clean($request->input('phone')),
                'password' => Hash::make($request->input('password')),
            ]);

            Auth::guard('customer')->loginUsingId($customer->getKey());
        }

        $booking = new Booking();

        $booking->fill($request->input());

        $booking->number_of_children = $request->input('number_of_children', 0);

        $startDate = HotelHelper::dateFromRequest($request->input('start_date'));
        $endDate = HotelHelper::dateFromRequest($request->input('end_date'));
        $numberOfRooms = $request->input('rooms', 1);

        $room->total_price = $room->getRoomTotalPrice($startDate, $endDate, $numberOfRooms);

        $serviceIds = $request->input('services', []);

        [$amount, $discountAmount] = $this->calculateBookingAmount($room, $serviceIds, $startDate->diffInDays($endDate), $numberOfRooms);

        $taxAmount = $room->tax->percentage * ($amount - $discountAmount) / 100;

        $sessionData = HotelHelper::getCheckoutData();

        $booking->coupon_amount = $discountAmount;
        $booking->coupon_code = Arr::get($sessionData, 'coupon_code');
        $booking->amount = ($amount - $discountAmount) + $taxAmount;
        $booking->sub_total = $amount;
        $booking->tax_amount = $taxAmount;
        $booking->transaction_id = Str::upper(Str::random(32));
        $booking->booking_number = Booking::generateUniqueBookingNumber();

        if (Auth::guard('customer')->check()) {
            $booking->customer_id = Auth::guard('customer')->id();
        }

        $booking->save();

        if ($serviceIds) {
            $booking->services()->attach($serviceIds);
        }

        session()->put('booking_transaction_id', $booking->transaction_id);

        BookingRoom::query()->create([
            'room_id' => $room->getKey(),
            'room_name' => $room->name,
            'room_image' => Arr::first($room->images),
            'booking_id' => $booking->getKey(),
            'price' => $room->total_price,
            'currency_id' => $room->currency_id,
            'number_of_rooms' => $numberOfRooms,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ]);

        $bookingAddress = new BookingAddress();
        $bookingAddress->fill($request->input());
        $bookingAddress->booking_id = $booking->getKey();
        $bookingAddress->save();

        $request->merge([
            'order_id' => $booking->getKey(),
        ]);

        $data = [
            'error' => false,
            'message' => false,
            'amount' => $booking->amount,
            'currency' => strtoupper(get_application_currency()->title),
            'type' => $request->input('payment_method'),
            'charge_id' => null,
        ];

        if (is_plugin_active('payment')) {
            session()->put('selected_payment_method', $data['type']);

            $paymentData = apply_filters(PAYMENT_FILTER_PAYMENT_DATA, [], $request);

            switch ($request->input('payment_method')) {
                case PaymentMethodEnum::COD:
                    $codPaymentService = app(CodPaymentService::class);
                    $data['charge_id'] = $codPaymentService->execute($paymentData);
                    $data['message'] = trans('plugins/payment::payment.payment_pending');

                    break;

                case PaymentMethodEnum::BANK_TRANSFER:
                    $bankTransferPaymentService = app(BankTransferPaymentService::class);
                    $data['charge_id'] = $bankTransferPaymentService->execute($paymentData);
                    $data['message'] = trans('plugins/payment::payment.payment_pending');

                    break;

                default:
                    $data = apply_filters(PAYMENT_FILTER_AFTER_POST_CHECKOUT, $data, $request);

                    break;
            }

            if ($checkoutUrl = Arr::get($data, 'checkoutUrl')) {
                return $response
                    ->setError($data['error'])
                    ->setNextUrl($checkoutUrl)
                    ->setData(['checkoutUrl' => $checkoutUrl])
                    ->withInput()
                    ->setMessage($data['message']);
            }

            if ($data['error'] || ! $data['charge_id']) {
                return $response
                    ->setError()
                    ->setNextUrl(PaymentHelper::getCancelURL())
                    ->withInput()
                    ->setMessage($data['message'] ?: __('Checkout error!'));
            }

            $bookingService->processBooking($booking->getKey(), $data['charge_id']);

            $redirectUrl = PaymentHelper::getRedirectURL();
        } else {
            $redirectUrl = route('public.booking.information', $booking->transaction_id);
        }

        if ($token = $request->input('token')) {
            session()->forget($token);
            session()->forget('checkout_token');
        }

        $newBooking = Booking::query()
            ->with('payment')
            ->whereKey($booking->getKey())
            ->firstOrFail();

        return $response
            ->setNextUrl($redirectUrl)
            ->setMessage(__('Booking successfully!'));
    }

    public function checkoutSuccess(string $transactionId)
    {
        $booking = Booking::query()
            ->where('transaction_id', $transactionId)
            ->firstOrFail();

        SeoHelper::setTitle(__('Booking Information'));

        Theme::breadcrumb()
            ->add(__('Booking'), route('public.booking.information', $transactionId));

        return Theme::scope('hotel.booking-information', compact('booking'))->render();
    }

    public function ajaxCalculateBookingAmount(
        CalculateBookingAmountRequest $request,
        BaseHttpResponse $response
    ) {
        $startDate = HotelHelper::dateFromRequest($request->input('start_date'));
        $endDate = HotelHelper::dateFromRequest($request->input('end_date'));
        $numberOfRooms = $request->input('rooms', 1);

        $room = Room::query()->findOrFail($request->input('room_id'));

        $nights = $startDate->diffInDays($endDate);

        $room->total_price = $room->getRoomTotalPrice($startDate, $endDate, $numberOfRooms);

        [$amount, $discountAmount] = $this->calculateBookingAmount($room, $request->input('services', []), $nights, $numberOfRooms);

        $taxAmount = $room->tax->percentage * ($amount - $discountAmount) / 100;

        $totalAmount = ($amount - $discountAmount) + $taxAmount;

        return $response->setData([
            'total_amount' => format_price($totalAmount),
            'amount_raw' => $totalAmount,
            'sub_total' => format_price($amount),
            'tax_amount' => format_price($taxAmount),
            'discount_amount' => format_price($discountAmount),
        ]);
    }

    public function changeCurrency(
        Request $request,
        BaseHttpResponse $response,
        $title = null
    ) {
        if (empty($title)) {
            $title = $request->input('currency');
        }

        if (! $title) {
            return $response;
        }

        $currency = Currency::query()
            ->where('title', $title)
            ->first();

        if ($currency) {
            cms_currency()->setApplicationCurrency($currency);
        }

        return $response;
    }

    public function getService(string $slug)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Service::class));

        if (! $slug) {
            abort(404);
        }

        $query = Service::query()
            ->wherePublished();

        $services = $query->get();

        $service  = $query->findOrFail($slug->reference_id);

        SeoHelper::setTitle($service->name)
            ->setDescription($service->description);

        SeoHelper::setSeoOpenGraph(
            (new SeoOpenGraph())
                ->setDescription($service->description)
                ->setUrl($service->url)
                ->setTitle($service->name)
                ->setType('article')
        );

        Theme::breadcrumb()->add($service->name, $service->url);

        return Theme::scope('hotel.service', compact('service', 'services'))->render();
    }

    protected function calculateBookingAmount(Room $room, array $servicesIds = [], $nights = 1, int $numberOfRooms = 1): array
    {
        $amount = $room->total_price;

        $serviceAmount = 0;
        $selectedServices = [];

        if ($servicesIds) {
            $services = Service::query()
                ->whereIn('id', $servicesIds)
                ->get();

            foreach ($services as $service) {
                if ($service->price_type == ServicePriceTypeEnum::PER_DAY) {
                    $serviceAmount += $service->price * $nights;
                } else {
                    $serviceAmount += $service->price;
                }
            }

            $serviceAmount *= $numberOfRooms;

            $amount += $serviceAmount;

            $selectedServices = $services->pluck('id')->values()->all();
        }

        $sessionData = HotelHelper::getCheckoutData();

        $sessionData['service_amount'] = $serviceAmount;
        $sessionData['selected_services'] = $selectedServices;

        $couponCode = Arr::get($sessionData, 'coupon_code');

        $discountAmount = 0;

        if ($couponCode) {
            $couponService = new CouponService();

            $coupon = $couponService->getCouponByCode($couponCode);

            if ($coupon !== null) {
                $discountAmount = $couponService->getDiscountAmount(
                    $coupon->type->getValue(),
                    $coupon->value,
                    $amount
                );
            }

            $sessionData['coupon_amount'] = $discountAmount;
            $sessionData['coupon_code'] = $couponCode;
        }

        HotelHelper::saveCheckoutData($sessionData);

        return [
            $amount,
            $discountAmount,
        ];
    }
}
