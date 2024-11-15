<?php

namespace Botble\Hotel\Providers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Hotel\Enums\BookingStatusEnum;
use Botble\Hotel\Models\Booking;
use Botble\Hotel\Models\Customer;
use Botble\Hotel\Services\BookingService;
use Botble\Media\Facades\RvMedia;
use Botble\Payment\Enums\PaymentMethodEnum;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Payment\Models\Payment;
use Botble\Payment\Supports\PaymentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        add_filter(BASE_FILTER_TOP_HEADER_LAYOUT, [$this, 'registerTopHeaderNotification'], 140);
        add_filter(BASE_FILTER_APPEND_MENU_NAME, [$this, 'countPendingBookings'], 140, 2);
        add_filter(BASE_FILTER_MENU_ITEMS_COUNT, [$this, 'getMenuItemCount'], 140);

        if (defined('PAYMENT_FILTER_REDIRECT_URL')) {
            add_filter(PAYMENT_FILTER_REDIRECT_URL, function ($checkoutToken) {
                return route('public.booking.information', $checkoutToken ?: session('booking_transaction_id'));
            }, 123);
        }

        if (defined('PAYMENT_FILTER_CANCEL_URL')) {
            add_filter(PAYMENT_FILTER_CANCEL_URL, function ($checkoutToken) {
                return route('public.booking.form', ['token' => $checkoutToken ?: session('checkout_token')] + ['error' => true, 'error_type' => 'payment']);
            }, 123);
        }

        if (defined('PAYMENT_ACTION_PAYMENT_PROCESSED')) {
            add_action(PAYMENT_ACTION_PAYMENT_PROCESSED, function ($data) {
                $orderIds = $data['order_id'];
                $orderId = Arr::first($orderIds);

                PaymentHelper::storeLocalPayment($data);

                return $this->app->make(BookingService::class)->processBooking($orderId, $data['charge_id']);
            });
        }

        if (defined('PAYMENT_FILTER_PAYMENT_DATA')) {
            add_filter(PAYMENT_FILTER_PAYMENT_DATA, function (array $data, Request $request) {
                $orderIds = (array) $request->input('order_id', []);

                $booking = Booking::query()->find(Arr::first($orderIds));

                if (! $booking) {
                    return [];
                }

                $rooms = [
                    [
                        'id' => $booking->getKey(),
                        'name' => $booking->room->room->name,
                        'image' => RvMedia::getImageUrl($booking->room->room->image),
                        'price' => $booking->amount + $booking->tax_amount - $booking->coupon_amount,
                        'price_per_order' => $booking->amount,
                        'qty' => 1,
                    ],
                ];

                $address = [
                    'name' => $booking->address->first_name . ' ' . $booking->address->last_name,
                    'email' => $booking->address->email,
                    'phone' => $booking->address->phone,
                    'country' => $booking->address->country,
                    'state' => $booking->address->state,
                    'city' => $booking->address->city,
                    'address' => $booking->address->address,
                    'zip' => $booking->address->zip,
                ];

                return [
                    'amount' => (float) $booking->amount,
                    'shipping_amount' => 0,
                    'shipping_method' => null,
                    'tax_amount' => $booking->tax_amount,
                    'discount_amount' => $booking->coupon_amount,
                    'currency' => strtoupper(get_application_currency()->title),
                    'order_id' => $orderIds,
                    'description' => trans('plugins/payment::payment.payment_description', ['order_id' => Arr::first($orderIds), 'site_url' => request()->getHost()]),
                    'customer_id' => auth('customer')->check() ? auth('customer')->id() : null,
                    'customer_type' => Customer::class,
                    'return_url' => $request->input('return_url'),
                    'callback_url' => $request->input('callback_url'),
                    'products' => $rooms,
                    'orders' => [$booking],
                    'address' => $address,
                    'checkout_token' => session('checkout_token'),
                ];
            }, 120, 2);
        }

        if (defined('PAYMENT_FILTER_PAYMENT_INFO_DETAIL')) {
            add_filter(PAYMENT_FILTER_PAYMENT_INFO_DETAIL, function ($html, $payment) {
                if (! $payment->order_id) {
                    return $html;
                }

                $booking = Booking::query()->find($payment->order_id);

                if (! $booking || ! $booking->address) {
                    return $html;
                }

                return view('plugins/hotel::partials.payment-info', compact('booking'))->render() . $html;
            }, 123, 2);
        }

        if (defined('ACTION_AFTER_UPDATE_PAYMENT')) {
            add_action(ACTION_AFTER_UPDATE_PAYMENT, function ($request, $payment) {
                if (
                    in_array($payment->payment_channel, [PaymentMethodEnum::COD, PaymentMethodEnum::BANK_TRANSFER])
                    && $request->input('status') == PaymentStatusEnum::COMPLETED
                ) {
                    Booking::query()
                        ->where('payment_id', $payment->id)
                        ->update(['status' => BookingStatusEnum::PROCESSING]);
                }
            }, 123, 2);
        }

        add_filter(BASE_FILTER_GET_LIST_DATA, function ($data, $model) {
            if (get_class($model) == Payment::class) {
                return $data
                    ->addColumn('customer_id', function ($item) {
                        if (! $item->order_id) {
                            return '&mdash;';
                        }

                        $booking = Booking::query()->find($item->order_id);

                        if (! $booking) {
                            return '&mdash;';
                        }

                        return $booking->address->first_name . ' ' . $booking->address->last_name;
                    })
                    ->filter(function ($query) {
                        $keyword = request()->input('search.value');
                        if ($keyword) {
                            return $query
                                ->join('ht_bookings', 'ht_bookings.id', '=', 'payments.order_id')
                                ->join('ht_booking_addresses', 'ht_booking_addresses.booking_id', '=', 'ht_bookings.id')
                                ->where(function ($subQuery) use ($keyword) {
                                    return $subQuery
                                        ->where('ht_booking_addresses.first_name', 'LIKE', '%' . $keyword . '%')
                                        ->orWhere('ht_booking_addresses.last_name', 'LIKE', '%' . $keyword . '%')
                                        ->orWhere(DB::raw('CONCAT(ht_booking_addresses.first_name, " ", ht_booking_addresses.last_name)'), 'LIKE', '%' . $keyword . '%')
                                        ->orWhere(DB::raw('CONCAT(ht_booking_addresses.last_name, " ", ht_booking_addresses.first_name)'), 'LIKE', '%' . $keyword . '%');
                                })
                                ->select('payments.*');
                        }

                        return $query;
                    });
            }

            return $data;
        }, 123, 2);

        add_filter(BASE_FILTER_TABLE_HEADINGS, function ($headings, $model) {
            if (get_class($model) == Payment::class) {
                return array_merge($headings, [
                    'customer_id' => [
                        'title' => trans('plugins/hotel::booking.customer'),
                        'class' => 'text-center no-sort',
                        'orderable' => false,
                        'searchable' => false,
                    ],
                ]);
            }

            return $headings;
        }, 123, 2);
    }

    public function registerTopHeaderNotification(?string $options): string
    {
        if (Auth::user()->hasPermission('booking.edit')) {
            $bookings = Booking::query()
                ->where('status', BaseStatusEnum::PENDING)
                ->select(['id', 'created_at'])
                ->with(['address'])
                ->orderByDesc('created_at')
                ->get();

            if ($bookings->isEmpty()) {
                return $options;
            }

            return $options . view('plugins/hotel::notification', compact('bookings'))->render();
        }

        return $options;
    }

    public function countPendingBookings(int|string|null $number, string $menuId): ?string
    {
        if ($menuId !== 'cms-plugins-booking') {
            return $number;
        }

        return view('core/base::partials.navbar.badge-count', ['class' => 'pending-bookings'])->render();
    }

    public function getMenuItemCount(array $data = []): array
    {
        if (Auth::user()->hasPermission('booking.index')) {
            $data[] = [
                'key' => 'pending-bookings',
                'value' => Booking::query()
                    ->where('status', BaseStatusEnum::PENDING)
                    ->count(),
            ];
        }

        return $data;
    }
}
