<section class="booking pt-90 pb-90 p-relative fix">
    @if ($shapeImage = $shortcode->shape_image)
        <div class="animations-01">
            <img src="{{ RvMedia::getImageUrl($shapeImage) }}" alt="{{ __('Shape image') }}">
        </div>
    @endif
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="contact-bg02">
                    <div class="section-title center-align">
                        @if ($subtitle = $shortcode->subtitle)
                            <h5>{!! BaseHelper::clean($subtitle) !!}</h5>
                        @endif
                        @if ($title = $shortcode->title)
                            <h2>{!! BaseHelper::clean($title) !!}</h2>
                        @endif
                    </div>
                    <form action="{{ route('public.booking') }}" method="post" class="contact-form mt-30 form-booking">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="contact-field p-relative c-name mb-20">
                                    <label for="booking-form-start-date"><i
                                            class="fal fa-badge-check"></i>{{ __('Check In Date') }}</label>
                                    <input type="text" id="booking-form-start-date" autocomplete="off"
                                           class="departure-date date-picker"
                                           data-date-format="{{ HotelHelper::getBookingFormDateFormat() }}"
                                           placeholder="{{ Carbon\Carbon::now()->format(HotelHelper::getDateFormat()) }}"
                                           data-locale="{{ App::getLocale() }}"
                                           value="{{ old('start_date', Carbon\Carbon::now()->format(HotelHelper::getDateFormat())) }}"
                                           name="start_date">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="contact-field p-relative c-subject mb-20">
                                    <label for="booking-form-end-date"><i
                                            class="fal fa-times-octagon"></i>{{ __('Check Out Date') }}</label>
                                    <input type="text" id="booking-form-end-date" autocomplete="off"
                                           class="arrival-date date-picker"
                                           data-date-format="{{ HotelHelper::getBookingFormDateFormat() }}"
                                           placeholder="{{ Carbon\Carbon::now()->addDay()->format(HotelHelper::getDateFormat()) }}"
                                           data-locale="{{ App::getLocale() }}"
                                           value="{{ BaseHelper::stringify(old('end_date', Carbon\Carbon::now()->addDay()->format(HotelHelper::getDateFormat()))) }}"
                                           name="end_date">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="contact-field p-relative c-subject mb-20">
                                    <label for="adults"><i class="fal fa-users"></i>{{ __('Guests') }}</label>
                                    <select name="adults" id="adults">
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" @selected(old('adults', HotelHelper::getMinimumNumberOfGuests()) === 1)>{{ $i }} {{ $i == 1 ? __('Guest') : __('Guests') }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="contact-field p-relative c-option mb-20">
                                    <label for="room"><i class="fal fa-concierge-bell"></i>{{ __('Room') }}</label>
                                    <select name="room_id" id="room">
                                        @foreach($rooms as $key => $value)
                                            <option @selected(old('room_id') === $key) value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="slider-btn mt-15">
                                    <button type="submit" class="btn ss-btn" data-animation="fadeInRight"
                                            data-delay=".8s">
                                        <span>{{ __('Book now') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                @if ($image = $shortcode->image)
                    <div class="booking-img">
                        <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ __('Image') }}">
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

