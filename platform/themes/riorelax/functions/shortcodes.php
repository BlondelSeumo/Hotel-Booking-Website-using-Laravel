<?php

use Botble\Base\Facades\Assets;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\InputFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormFieldOptions;
use Botble\Contact\Forms\ShortcodeContactAdminConfigForm;
use Botble\Faq\Models\Faq;
use Botble\Faq\Models\FaqCategory;
use Botble\Hotel\Facades\HotelHelper;
use Botble\Hotel\Models\Amenity;
use Botble\Hotel\Models\Place;
use Botble\Hotel\Models\Room;
use Botble\Hotel\Models\Service;
use Botble\Hotel\Repositories\Interfaces\RoomInterface;
use Botble\Hotel\Shortcodes\Forms\ShortcodeHotelPlaceForm;
use Botble\Hotel\Shortcodes\Forms\ShortcodeHotelServiceForm;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\FieldOptions\ShortcodeTabsFieldOption;
use Botble\Shortcode\Forms\Fields\ShortcodeColorField;
use Botble\Shortcode\Forms\Fields\ShortcodeTabsField;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Shortcode\ShortcodeField;
use Botble\Team\Models\Team;
use Botble\Testimonial\Models\Testimonial;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Forms\Fields\ThemeIconField;
use Botble\Theme\Supports\ThemeSupport;
use Botble\Theme\Supports\Youtube;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

app()->booted(function () {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    if (is_plugin_active('simple-slider')) {
        add_filter(SIMPLE_SLIDER_VIEW_TEMPLATE, function (): ?string {
            return Theme::getThemeNamespace('partials.shortcodes.simple-slider.index');
        });

        Shortcode::register(
            'hero-banner-with-booking-form',
            __('Hero banner with booking form'),
            __('Hero banner with booking form'),
            function (ShortcodeCompiler $shortcode): ?string {
                if (App::getLocale() !== 'en') {
                    Theme::asset()
                        ->container('footer')
                        ->usePath(false)
                        ->add(
                            'bootstrap-datepicker-locale',
                            sprintf(
                                '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.%s.min.js',
                                App::getLocale()
                            ),
                        );
                }

                return Theme::partial('shortcodes.hero-banner-with-booking-form.index', compact('shortcode'));
            }
        );

        Shortcode::setAdminConfig('hero-banner-with-booking-form', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
                ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
                ->add(
                    'background_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Background image'))
                        ->toArray()
                )
                ->add(
                    'background_color',
                    ShortcodeColorField::class,
                    InputFieldOption::make()
                        ->label(__('Background color'))
                        ->defaultValue('#101010')
                        ->toArray()
                )
                ->add('button_label', TextField::class, TextFieldOption::make()->label(__('Button label'))->toArray())
                ->add('button_url', TextField::class, TextFieldOption::make()->label(__('Button URL'))->toArray())
                ->add('form_title', TextField::class, TextFieldOption::make()->label(__('Form title'))->toArray())
                ->add(
                    'form_button_label',
                    TextField::class,
                    TextFieldOption::make()->label(__('Form button label'))->toArray()
                )
                ->add(
                    'form_button_url',
                    TextField::class,
                    TextFieldOption::make()->label(__('Form button URL'))->toArray()
                );
        });
    }

    if (is_plugin_active('hotel')) {
        Shortcode::register(
            'check-availability-form',
            __('Check availability form'),
            __('Check availability form'),
            function (ShortcodeCompiler $shortcode): ?string {
                return Theme::partial('shortcodes.check-availability-form.index', compact('shortcode'));
            }
        );

        Shortcode::register(
            'booking-form',
            __('Booking form'),
            __('Booking form'),
            function (ShortcodeCompiler $shortcode): ?string {
                $limit = $shortcode->limit ?: 6;

                $rooms = Room::query()
                    ->wherePublished()
                    ->limit($limit)
                    ->pluck('name', 'id');

                return Theme::partial('shortcodes.booking-form.index', compact('shortcode', 'rooms'));
            }
        );

        Shortcode::setAdminConfig('booking-form', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
                ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
                ->add('image', MediaImageField::class)
                ->add(
                    'shape_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Shape image'))
                        ->toArray()
                )
                ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Limit'))->toArray());
        });

        Assets::addStyles('coloris');

        Shortcode::register(
            'featured-rooms',
            __('Featured Rooms'),
            __('Featured Rooms'),
            function (ShortcodeCompiler $shortcode): ?string {
                if (! $shortcode->room_ids) {
                    return null;
                }

                $roomIds = explode(',', $shortcode->room_ids);

                if (! $roomIds) {
                    return null;
                }

                [$startDate, $endDate, $adults, $nights] = HotelHelper::getRoomBookingParams();

                $params = [
                    'condition' => [
                        ['id', 'IN', $roomIds],
                    ],
                    'with' => [
                        'amenities',
                        'amenities.metadata',
                        'slugable',
                        'activeBookingRooms' => function ($query) use ($startDate, $endDate) {
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
                        },
                        'activeRoomDates' => function ($query) use ($startDate, $endDate) {
                            return $query
                                ->whereDate('start_date', '>=', $startDate->startOfDay())
                                ->whereDate('end_date', '<=', $endDate->endOfDay())
                                ->take(40);
                        },
                    ],
                ];

                $queriedRooms = app(RoomInterface::class)->getRooms([], $params);

                $rooms = [];

                $dateFormat = 'Y-m-d';

                $condition = [
                    'start_date' => $startDate->format($dateFormat),
                    'end_date' => $endDate->format($dateFormat),
                    'adults' => $adults,
                    'children' => Request::input('children', 0),
                    'rooms' => Request::input('rooms', 1),
                ];

                foreach ($queriedRooms as &$room) {
                    if ($room->isAvailableAt($condition)) {
                        $room->total_price = $room->getRoomTotalPrice($startDate, $endDate, $condition['rooms']);

                        $rooms[] = $room;
                    }
                }

                return Theme::partial(
                    'shortcodes.featured-rooms.index',
                    compact('shortcode', 'rooms', 'startDate', 'endDate', 'adults', 'nights')
                );
            }
        );

        Shortcode::setAdminConfig('featured-rooms', function (array $attributes) {
            $rooms = Room::query()
                ->wherePublished()
                ->pluck('name', 'id')
                ->toArray();

            $roomIds = explode(',', Arr::get($attributes, 'room_ids'));

            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
                ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
                ->add(
                    'room_ids',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Choose rooms'))
                        ->choices($rooms)
                        ->selected($roomIds)
                        ->multiple()
                        ->searchable()
                        ->toArray(),
                );
        });

        Shortcode::register(
            'featured-amenities',
            __('Featured amenities'),
            __('Featured amenities'),
            function (ShortcodeCompiler $shortcode): ?string {
                if (! $shortcode->amenity_ids) {
                    return null;
                }

                $amenityIds = explode(',', $shortcode->amenity_ids);

                if (! $amenityIds) {
                    return null;
                }

                $amenities = Amenity::query()
                    ->wherePublished()
                    ->whereIn('id', $amenityIds)
                    ->get();

                return Theme::partial('shortcodes.featured-amenities.index', compact('shortcode', 'amenities'));
            }
        );

        Shortcode::setAdminConfig('featured-amenities', function (array $attributes) {
            $amenities = Amenity::query()
                ->wherePublished()
                ->pluck('name', 'id')
                ->all();

            $amenityIds = explode(',', Arr::get($attributes, 'amenity_ids'));

            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
                ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
                ->add(
                    'background_color',
                    ShortcodeColorField::class,
                    InputFieldOption::make()
                        ->label(__('Background color'))
                        ->defaultValue('#f7f5f1')
                        ->toArray()
                )
                ->add(
                    'background_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Background image'))
                        ->toArray()
                )
                ->add(
                    'amenity_ids',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Choose amenities'))
                        ->choices($amenities)
                        ->multiple()
                        ->searchable()
                        ->selected($amenityIds)
                        ->toArray()
                );
        });

        Shortcode::register(
            'room-list',
            __('Room list'),
            __('Room list'),
            function (ShortcodeCompiler $shortcode): ?string {
                $limit = $shortcode->limit ?: 6;

                $rooms = Room::query()
                    ->wherePublished()
                    ->limit($limit)
                    ->get();

                [$startDate, $endDate, $adults, $nights] = HotelHelper::getRoomBookingParams();

                return Theme::partial(
                    'shortcodes.room-list.index',
                    compact('shortcode', 'rooms', 'startDate', 'endDate', 'adults', 'nights')
                );
            }
        );

        Shortcode::setAdminConfig('room-list', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add(
                    'limit',
                    NumberField::class,
                    NumberFieldOption::make()
                        ->label(__('Limit'))
                        ->toArray()
                );
        });

        Shortcode::register('all-rooms', __('All Rooms'), __('All Rooms'), function (): ?string {
            $request = request();

            [$startDate, $endDate, $adults, $nights] = HotelHelper::getRoomBookingParams();

            $filters = [
                'keyword' => $request->query('q'),
            ];

            $params = [
                'paginate' => [
                    'per_page' => 100,
                    'current_paged' => $request->integer('page', 1),
                ],
                'with' => [
                    'amenities',
                    'amenities.metadata',
                    'slugable',
                    'activeBookingRooms' => function ($query) use ($startDate, $endDate) {
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
                    },
                    'activeRoomDates' => function ($query) use ($startDate, $endDate) {
                        return $query
                            ->whereDate('start_date', '>=', $startDate->startOfDay())
                            ->whereDate('end_date', '<=', $endDate->endOfDay())
                            ->take(40);
                    },
                ],
            ];

            $queriedRooms = app(RoomInterface::class)->getRooms($filters, $params);

            $rooms = [];

            $dateFormat = 'Y-m-d';

            $condition = [
                'start_date' => $startDate->format($dateFormat),
                'end_date' => $endDate->format($dateFormat),
                'adults' => $adults,
            ];

            foreach ($queriedRooms as &$room) {
                if ($room->isAvailableAt($condition)) {
                    $room->total_price = $room->getRoomTotalPrice($startDate, $endDate);

                    $rooms[] = $room;
                }
            }

            $rooms = new LengthAwarePaginator(
                $rooms,
                count($rooms),
                100,
                Paginator::resolveCurrentPage(),
                ['path' => Paginator::resolveCurrentPath()]
            );

            return Theme::partial(
                'shortcodes.all-rooms.index',
                compact('rooms', 'startDate', 'endDate', 'nights', 'adults')
            );
        });

        Shortcode::register(
            'service-list',
            __('Service list'),
            __('Service list'),
            function (ShortcodeCompiler $shortcode): ?string {
                $limit = $shortcode->limit ?: 6;

                $services = Service::query()
                    ->wherePublished()
                    ->limit($limit)
                    ->get();

                return Theme::partial('shortcodes.service-list.index', compact('shortcode', 'services'));
            }
        );

        Shortcode::setAdminConfig('service-list', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add(
                    'background_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Background image'))
                        ->toArray()
                )
                ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Limit'))->toArray());
        });

        Shortcode::register(
            'hotel-places',
            __('Hotel Places'),
            __('Hotel Places'),
            function (ShortcodeCompiler $shortcode): ?string {
                if (! $placeIds = Shortcode::fields()->getIds('place_ids', $shortcode)) {
                    return null;
                }

                $places = Place::query()
                    ->with('slugable')
                    ->wherePublished()
                    ->whereIn('id', $placeIds)
                    ->get();

                if ($places->isEmpty()) {
                    return null;
                }

                return Theme::partial('shortcodes.hotel-places.index', compact('shortcode', 'places'));
            }
        );

        Shortcode::setPreviewImage('hotel-places', Theme::asset()->url('images/ui-blocks/hotel-places.png'));

        Shortcode::setAdminConfig('hotel-places', function (array $attributes) {
            if ($placeIds = ShortcodeField::parseIds(Arr::get($attributes, 'place_ids'))) {
                $attributes['place_ids'] = $placeIds;
            }

            return ShortcodeHotelPlaceForm::createFromArray($attributes)
                ->addAfter(
                    'title',
                    'subtitle',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle'))
                        ->toArray()
                )
                ->addAfter(
                    'subtitle',
                    'description',
                    TextareaField::class,
                    DescriptionFieldOption::make()
                        ->toArray()
                );
        });

        Shortcode::register(
            'hotel-services',
            __('Hotel Services'),
            __('Hotel Services'),
            function (ShortcodeCompiler $shortcode): ?string {
                if (! $serviceIds = Shortcode::fields()->getIds('service_ids', $shortcode)) {
                    return null;
                }

                $services = Service::query()
                    ->with('slugable')
                    ->wherePublished()
                    ->whereIn('id', $serviceIds)
                    ->get();

                if ($services->isEmpty()) {
                    return null;
                }

                return Theme::partial('shortcodes.hotel-services.index', compact('shortcode', 'services'));
            }
        );

        Shortcode::setPreviewImage('hotel-services', Theme::asset()->url('images/ui-blocks/hotel-services.png'));

        Shortcode::setAdminConfig('hotel-services', function (array $attributes) {
            if ($serviceIds = ShortcodeField::parseIds(Arr::get($attributes, 'service_ids'))) {
                $attributes['service_ids'] = $serviceIds;
            }

            return ShortcodeHotelServiceForm::createFromArray($attributes)
                ->addAfter(
                    'title',
                    'subtitle',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle'))
                        ->toArray()
                )
                ->addAfter(
                    'subtitle',
                    'description',
                    TextareaField::class,
                    DescriptionFieldOption::make()
                        ->toArray()
                );

        });
    }

    if (is_plugin_active('testimonial')) {
        Shortcode::register(
            'testimonials',
            __('Testimonials'),
            __('Testimonials'),
            function (ShortcodeCompiler $shortcode): ?string {
                if (! $testimonialIds = Shortcode::fields()->getIds('testimonial_ids', $shortcode)) {
                    return null;
                }

                $testimonials = Testimonial::query()
                    ->wherePublished()
                    ->whereIn('id', $testimonialIds)
                    ->get();

                return Theme::partial('shortcodes.testimonials.index', compact('shortcode', 'testimonials'));
            }
        );

        Shortcode::setAdminConfig('testimonials', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
                ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
                ->add(
                    'background_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Background image'))
                        ->toArray()
                )
                ->add(
                    'testimonial_ids',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Choose testimonials'))
                        ->choices(
                            Testimonial::query()
                            ->wherePublished()
                            ->pluck('name', 'id')
                            ->all()
                        )
                        ->selected(ShortcodeField::parseIds(Arr::get($attributes, 'testimonial_ids')))
                        ->multiple()
                        ->searchable()
                        ->toArray()
                );
        });
    }

    Shortcode::register(
        'about-us',
        __('About Us'),
        __('About Us'),
        function (ShortcodeCompiler $shortcode): ?string {
            $highlightArray = explode('; ', $shortcode->highlights);

            return Theme::partial('shortcodes.about-us.index', compact('shortcode', 'highlightArray'));
        }
    );

    Shortcode::setAdminConfig('about-us', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->columns()
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->colspan(2)->toArray())
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->colspan(2)->toArray())
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->maxLength(2000)->colspan(2)->toArray())
            ->add(
                'highlights',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->helperText(__('Split each highlight by semicolon ‘; ’ for a new bulleted row.'))
                    ->colspan(2)
                    ->label(__('Highlights'))
                    ->toArray()
            )
            ->add(
                'style',
                SelectField::class,
                SelectFieldOption::make()
                    ->choices([
                        'style-1' => __('Style :number', ['number' => 1]),
                        'style-2' => __('Style :number', ['number' => 2]),
                    ])
                    ->label(__('Style'))
                    ->colspan(2)
                    ->toArray()
            )
            ->add(
                'button_label',
                TextField::class,
                TextFieldOption::make()->colspan(2)->label(__('Button label'))->toArray()
            )
            ->add(
                'button_url',
                TextField::class,
                TextFieldOption::make()->colspan(2)->label(__('Button URL'))->toArray()
            )
            ->add(
                'signature_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->colspan(2)
                    ->label(__('Signature image'))
                    ->toArray()
            )
            ->add(
                'signature_author',
                TextField::class,
                TextFieldOption::make()
                    ->colspan(2)
                    ->label(__('Signature author'))
                    ->toArray()
            )
            ->add(
                'top_left_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Top left image'))
                    ->toArray()
            )
            ->add(
                'bottom_right_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Bottom right image'))
                    ->toArray()
            )
            ->add(
                'floating_right_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Floating right image'))
                    ->toArray()
            );
    });

    Shortcode::register(
        'why-choose-us',
        __('Why Choose Us'),
        __('Why Choose Us'),
        function (ShortcodeCompiler $shortcode): ?string {
            $tabs = Shortcode::fields()->getTabsData(['title', 'percentage'], $shortcode);

            return Theme::partial('shortcodes.why-choose-us.index', compact('shortcode', 'tabs'));
        }
    );

    Shortcode::setAdminConfig('why-choose-us', function (array $attributes) {
        $fields = [
            'title' => [
                'type' => 'text',
                'title' => __('Title'),
            ],
            'percentage' => [
                'type' => 'percentage',
                'title' => __('Percentage'),
            ],
        ];

        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add(
                'right_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__(__('Right Image')))
                    ->toArray()
            )
            ->add(
                'background_color',
                ShortcodeColorField::class,
                InputFieldOption::make()
                    ->label(__('Background color'))
                    ->defaultValue('#291d116')
                    ->toArray()
            )
            ->add(
                'background_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background Image'))
                    ->toArray()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields($fields)
                    ->toArray()
            );
    });

    Shortcode::register(
        'services',
        __('Services'),
        __('Services'),
        function (ShortcodeCompiler $shortcode): ?string {
            return Theme::partial('shortcodes.services.index', compact('shortcode'));
        }
    );

    Shortcode::setAdminConfig('services', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add(
                'left_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Left image'))
                    ->toArray()
            )
            ->add(
                'right_floating_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Right floating image'))
                    ->toArray()
            )
            ->add('button_label', TextField::class, TextFieldOption::make()->label(__('Button label'))->toArray())
            ->add('button_url', TextField::class, TextFieldOption::make()->label(__('Button URL'))->toArray());
    });

    if (is_plugin_active('newsletter')) {
        Shortcode::register(
            'newsletter',
            __('Newsletter'),
            __('Newsletter'),
            function (ShortcodeCompiler $shortcode): ?string {
                return Theme::partial('shortcodes.newsletter.index', compact('shortcode'));
            }
        );

        Shortcode::setAdminConfig('newsletter', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
                ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
                ->add(
                    'background_color',
                    ShortcodeColorField::class,
                    InputFieldOption::make()
                        ->label(__('Background color'))
                        ->defaultValue('#f7f5f1')
                        ->toArray()
                )
                ->add(
                    'left_floating_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Left floating image'))
                        ->toArray()
                );
        });
    }

    if (is_plugin_active('contact')) {
        add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
            return Theme::getThemeNamespace('partials.shortcodes.contact-form.index');
        }, 120);

        Shortcode::modifyAdminConfig('contact-form', function (ShortcodeContactAdminConfigForm $form) {
            $form
                ->add(
                    'title',
                    TextField::class,
                    TextFieldOption::make()
                        ->colspan(2)
                        ->label(__('Title'))
                        ->toArray()
                )
                ->add(
                    'button_label',
                    TextField::class,
                    TextFieldOption::make()
                        ->colspan(2)
                        ->label(__('Button label'))
                        ->toArray()
                );

            $fields = [
                'address' => [
                    'icon' => __('Address icon'),
                    'label' => __('Address label'),
                    'detail' => __('Address detail'),
                ],
                'email' => [
                    'icon' => __('Email icon'),
                    'label' => __('Email label'),
                    'detail' => __('Email detail'),
                ],
                'work_time' => [
                    'icon' => __('Work time icon'),
                    'label' => __('Work time label'),
                    'detail' => __('Work time detail'),
                ],
                'phone' => [
                    'icon' => __('Phone icon'),
                    'label' => __('Phone label'),
                    'detail' => __('Phone detail'),
                ],
            ];

            foreach ($fields as $key => $label) {
                $form
                    ->add(
                        $key . '_icon',
                        ThemeIconField::class,
                        FormFieldOptions::make()->label($label['icon'])->toArray()
                    )
                    ->add($key . '_label', TextField::class, TextFieldOption::make()->label($label['label'])->toArray())
                    ->add(
                        $key . '_detail',
                        TextareaField::class,
                        TextareaFieldOption::make()
                            ->colspan(2)
                            ->label($label['detail'])
                            ->toArray()
                    );
            }

            return $form;
        });
    }

    Shortcode::register('brands', __('Brands'), __('Brands'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData(['name', 'image', 'link'], $shortcode);

        return Theme::partial('shortcodes.brands.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setAdminConfig('brands', function (array $attributes) {
        $fields = [
            'name' => [
                'title' => __('Name'),
                'required' => true,
            ],
            'image' => [
                'type' => 'image',
                'title' => __('Logo'),
                'required' => true,
            ],
            'link' => [
                'type' => 'text',
                'title' => __('URL'),
                'required' => false,
            ],
        ];

        return ShortcodeForm::createFromArray($attributes)
            ->add(
                'background_color',
                ShortcodeColorField::class,
                InputFieldOption::make()
                    ->label(__('Background color'))
                    ->defaultValue('#f7f5f1')
                    ->toArray()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields($fields)
                    ->toArray()
            );
    });

    Shortcode::register(
        'feature-area',
        __('Feature area'),
        __('Feature area'),
        function (ShortcodeCompiler $shortcode): ?string {
            return Theme::partial('shortcodes.feature-area.index', compact('shortcode'));
        }
    );

    Shortcode::setAdminConfig('feature-area', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add('image', MediaImageField::class)
            ->add(
                'background_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background'))
                    ->toArray()
            )
            ->add('button_primary_label', TextField::class, TextFieldOption::make()->label(__('Button label'))->toArray())
            ->add('button_primary_url', TextField::class, TextFieldOption::make()->label(__('Button URL'))->toArray());
    });

    Shortcode::register('pricing', __('Pricing'), __('Pricing'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData([
            'title',
            'description',
            'price',
            'duration',
            'feature_list',
            'button_label',
            'button_url',
        ], $shortcode);

        return Theme::partial('shortcodes.pricing.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setAdminConfig('pricing', function (array $attributes) {
        $fields = [
            'title' => [
                'title' => __('Title'),
                'required' => true,
            ],
            'description' => [
                'type' => 'textarea',
                'title' => __('Description'),
                'required' => false,
            ],
            'price' => [
                'title' => __('Price'),
                'required' => true,
            ],
            'duration' => [
                'title' => __('Duration'),
                'required' => true,
            ],
            'feature_list' => [
                'type' => 'textarea',
                'title' => __('Feature list'),
                'required' => true,
            ],
            'button_label' => [
                'title' => __('Button label'),
                'required' => true,
            ],
            'button_url' => [
                'title' => __('Button URL'),
                'required' => true,
            ],
        ];

        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add(
                'background_image_1',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image :number', ['number' => 1]))
                    ->toArray()
            )
            ->add(
                'background_image_2',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image :number', ['number' => 2]))
                    ->toArray()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields($fields)
                    ->toArray()
            );
    });

    Shortcode::register(
        'intro-video',
        __('Intro Video'),
        __('Intro Video'),
        function (ShortcodeCompiler $shortcode): ?string {
            $shortcode->youtube_video_id = $shortcode->youtube_url ? Youtube::getYoutubeVideoID(
                $shortcode->youtube_url
            ) : null;

            return Theme::partial('shortcodes.intro-video.index', compact('shortcode'));
        }
    );

    Shortcode::setAdminConfig('intro-video', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
            ->add('youtube_url', TextField::class, TextFieldOption::make()->label(__('Youtube URL'))->toArray())
            ->add(
                'button_icon',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Button icon image'))
                    ->toArray()
            )
            ->add(
                'background_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image'))
                    ->toArray()
            );
    });

    Shortcode::register(
        'user-profile',
        __('User profile'),
        __('User profile'),
        function (ShortcodeCompiler $shortcode): ?string {
            $tabs = Shortcode::fields()->getTabsData(['title', 'percentage'], $shortcode);

            return Theme::partial('shortcodes.user-profile.index', compact('shortcode', 'tabs'));
        }
    );

    Shortcode::setAdminConfig('user-profile', function (array $attributes) {
        $fields = [
            'title' => [
                'title' => __('Title'),
                'required' => true,
            ],
            'percentage' => [
                'type' => 'text',
                'title' => __('Percentage'),
                'required' => false,
            ],
        ];

        return ShortcodeForm::createFromArray($attributes)
            ->add(
                'image_1',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image :number', ['number' => 1]))
                    ->toArray()
            )
            ->add(
                'image_2',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image :number', ['number' => 2]))
                    ->toArray()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields($fields)
                    ->toArray()
            );
    });

    if (is_plugin_active('blog')) {
        Shortcode::register('news', __('News'), __('News'), function (ShortcodeCompiler $shortcode): ?string {
            $limit = (int) $shortcode->limit ?: 4;

            $posts = match ($shortcode->type) {
                'popular' => get_popular_posts($limit),
                'featured' => get_featured_posts($limit),
                'recent' => get_recent_posts($limit),
                default => get_latest_posts($limit),
            };

            if ($posts->isEmpty()) {
                return null;
            }

            return Theme::partial('shortcodes.news.index', compact('shortcode', 'posts'));
        });

        Shortcode::setAdminConfig('news', function (array $attributes) {
            $types = [
                'latest' => __('Latest'),
                'popular' => __('Popular'),
                'featured' => __('Featured'),
                'recent' => __('Recent'),
            ];

            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
                ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
                ->add(
                    'background_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->label(__('Background image'))
                        ->toArray()
                )
                ->add(
                    'type',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->choices($types)
                        ->toArray()
                )
                ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Limit'))->toArray());
        });
    }

    if (is_plugin_active('team')) {
        Shortcode::register('teams', __('Team'), __('Team'), function (ShortcodeCompiler $shortcode): ?string {
            if (! $shortcode->team_ids) {
                return null;
            }

            $teamIds = explode(',', $shortcode->team_ids);

            if (! $teamIds) {
                return null;
            }

            $teams = Team::query()
                ->whereIn('id', $teamIds)
                ->wherePublished()
                ->get();

            return Theme::partial('shortcodes.teams.index', compact('shortcode', 'teams'));
        });

        Shortcode::setAdminConfig('teams', function (array $attributes) {
            $teams = Team::query()
                ->wherePublished()
                ->pluck('name', 'id')
                ->all();

            $teamIds = explode(',', Arr::get($attributes, 'team_ids'));

            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
                ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle'))->toArray())
                ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
                ->add(
                    'team_ids',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Choose teams'))
                        ->choices($teams)
                        ->selected($teamIds)
                        ->multiple()
                        ->searchable()
                        ->toArray()
                )
                ->add(
                    'style',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Style'))
                        ->choices([
                            'style-1' => __('Style :number', ['number' => 1]),
                            'style-2' => __('Style :number', ['number' => 2]),
                        ])
                        ->toArray()
                );
        });
    }

    if (is_plugin_active('faq')) {
        Shortcode::register('faqs', __('FAQs'), __('FAQs'), function (ShortcodeCompiler $shortcode): ?string {
            $categoryIds = $shortcode->category_ids ? explode(',', $shortcode->category_ids) : [];

            $faqs = collect();

            if (! empty($categoryIds)) {
                $faqs = Faq::query()
                    ->whereIn('category_id', $categoryIds)
                    ->wherePublished()
                    ->get();
            }

            return Theme::partial('shortcodes.faqs.index', compact('shortcode', 'faqs'));
        });

        Shortcode::setAdminConfig('faqs', function (array $attributes) {
            $categories = FaqCategory::query()
                ->pluck('name', 'id')
                ->toArray();

            $categoryIds = explode(',', Arr::get($attributes, 'category_ids', ''));

            return ShortcodeForm::createFromArray($attributes)
                ->add(
                    'category_ids',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('FAQ categories'))
                        ->choices($categories)
                        ->multiple()
                        ->searchable()
                        ->selected($categoryIds)
                        ->toArray()
                );
        });
    }

    if (is_plugin_active('gallery')) {
        Shortcode::register(
            'galleries',
            __('Galleries'),
            __('Galleries'),
            function (ShortcodeCompiler $shortcode): ?string {
                $limit = (int) $shortcode->limit ?: 5;

                $galleries = get_galleries($limit);

                if ($galleries->isEmpty()) {
                    return null;
                }

                return Theme::partial('shortcodes.galleries.index', compact('shortcode', 'galleries'));
            }
        );

        Shortcode::setAdminConfig('galleries', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('limit', NumberField::class, NumberFieldOption::make()->label(__('Limit'))->toArray());
        });
    }
});
