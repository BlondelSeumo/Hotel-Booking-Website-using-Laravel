@php
    Theme::asset()->container('footer')->usePath()->add('lightgallery-css', 'plugins/lightgallery/css/lightgallery.min.css');
    Theme::asset()->container('footer')->usePath()->add('lightgallery-js', 'plugins/lightgallery/js/lightgallery.min.js');

    Theme::set('pageTitle', $room->name);
    $nights = $startDate->diffInDays($endDate);
@endphp
<div class="about-area5 about-p p-relative room-details">
    <div class="container pt-60 pb-40">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 order-2">
                <aside class="sidebar services-sidebar">
                    @if (HotelHelper::isBookingEnabled())
                        <div class="sidebar-widget categories">
                            <div class="widget-content">
                                <h2 class="widget-title"> {{ __('Booking form') }} </h2>
                                <div class="booking">
                                    <div class="contact-bg">
                                        {!! Theme::partial('hotel.forms.form', ['availableForBooking' => true, 'style' => 1, 'room' => $room]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {!! dynamic_sidebar('room_sidebar') !!}
                </aside>
            </div>

            <div class="col-lg-8 col-md-12 col-sm-12 order-1">
                <div class="service-detail">
                    <div class="thumb">
                        <div class="room-details-slider">
                            @foreach ($room->images as $img)
                                <a href="{{ RvMedia::getImageUrl($img) }}">
                                    <img src="{{ RvMedia::getImageUrl($img, 'room-image') }}" alt="{{ $room->name }}">
                                </a>
                            @endforeach
                        </div>
                        <div class="room-details-slider-nav">
                            @foreach ($room->images as $img)
                                <img src="{{ RvMedia::getImageUrl($img, 'thumb') }}" alt="{{ $room->name }}">
                            @endforeach
                        </div>
                    </div>
                    <div class="content-box">
                        <div class="row align-items-center mb-50">
                            <div class="col-12">
                                <div class="price">
                                    <h2>{{ $room->name }}</h2>
                                    @if ($nights > 1)
                                        <span>{{ __(':price for :nights nights', ['price' => format_price($room->getRoomTotalPrice($startDate, $endDate)), 'nights' => $nights]) }}</span>
                                    @else
                                        <span>{{ __(':price ', ['price' => format_price($room->getRoomTotalPrice($startDate, $endDate))]) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {!! BaseHelper::clean($room->content) !!}

                        @if ($room->amenities->isNotEmpty())
                            <div class="room-block-content shadow-block mt-50 amenities-list">
                                <h3>{{ __('Amenities') }}</h3>
                                <div class="row">
                                    @foreach ($room->amenities as $amenity)
                                        @if ($image = $amenity->getMetaData('icon_image', true) )
                                            <div class="col-xl-4 col-lg-6 col-12 d-flex align-items-center mb-3">
                                                <img width="20px" class="d-block" src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $amenity->name }}">
                                                <span class="ms-2">{{ $amenity->name }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($rules = theme_option('hotel_rules'))
                            <div class="room-block-content shadow-block">
                                <div class="hotel-rules-box">
                                    <h3>{{ __('Hotel Rules') }}</h3>
                                    {!! BaseHelper::clean($rules) !!}
                                </div>
                            </div>
                        @endif

                        @if ($cancellation = theme_option('cancellation'))
                            <div class="room-block-content shadow-block">
                                <h3>{{ __('Cancellation') }}</h3>
                                {!! BaseHelper::clean($cancellation) !!}
                            </div>
                        @endif

                        @if(HotelHelper::isReviewEnabled())
                            @include(Theme::getThemeNamespace('views.hotel.partials.reviews'), ['model' => $room])
                        @endif

                        <div class="content-box related-room">
                            <h3>{{ __('Related Rooms') }}</h3>
                            <div class="row">
                                @foreach($relatedRooms as $room)
                                    <div class="col-lg-6 mb-20">
                                        {!! Theme::partial('rooms.item', compact('room', 'startDate', 'endDate', 'nights', 'adults')) !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
