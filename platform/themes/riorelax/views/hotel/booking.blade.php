@if (is_plugin_active('payment'))
    <link rel="stylesheet" href="{{ asset('vendor/core/plugins/payment/css/payment.css') }}?v=1.0.3">
    @php
        Theme::asset()->container('header')->usePath()->add('jquery', 'plugins/jquery.min.js');
        Theme::asset()->container('header')->add('payment-js', 'vendor/core/plugins/payment/js/payment.js');
    @endphp

    {!! apply_filters(PAYMENT_FILTER_HEADER_ASSETS, null) !!}
@endif
@php
    Theme::set('pageTitle', __('Booking'));
    Theme::asset()->container('footer')->usePath()->add('checkout-js', 'js/checkout.js');
@endphp

<section class="checkout-booking-page">
    <div class="container pt-120 pb-40 checkout-booking">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <form action="{{ route('public.booking.checkout') }}" class="booking-form-main payment-checkout-form mb-50 shadow-block" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="amount" value="{{ $total }}">
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <input type="hidden" name="start_date" value="{{ $startDate->format(HotelHelper::getDateFormat()) }}">
                    <input type="hidden" name="end_date" value="{{ $endDate->format(HotelHelper::getDateFormat()) }}">
                    <input type="hidden" name="adults" value="{{ $adults }}">
                    <input name="number_of_children" type="hidden" value="{{ $children }}">
                    <input name="rooms" type="hidden" value="{{ $rooms }}"/>
                    <input type="hidden" name="currency" value="{{ strtoupper(get_application_currency()->title) }}">
                    <input type="hidden" name="currency_id" value="{{ get_application_currency_id() }}">
                    @if (is_plugin_active('paypal'))
                        <input type="hidden" name="callback_url" value="{{ route('payments.paypal.status') }}">
                    @endif

                    <input type="hidden" name="number_of_guests" value="{{ $adults }}">

                    @if (! $customer->id)
                        <p>{{ __('Already have an account?') }} <a href="{{ route('customer.login') }}">{{ __(' Login') }}</a></p>
                    @endif

                    <div class="mb-20">
                        <h3 class="">{{ __('Add Extra Services') }}</h3>
                    </div>
                    <div class="room-booking-form p-0 mb-20">
                        @php
                            $chunks = $services->chunk(ceil($services->count() / 2));
                        @endphp
                        <div class="row">
                            @if (count($chunks) > 0)
                                <div class="col-md-6">
                                    @foreach($chunks[0] as $service)
                                        <div class="form-group mb-20 custom-checkbox">
                                            <label for="service_{{ $service->id }}">
                                                <input type="checkbox" class="service-item" id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}" @if (in_array($service->id, (array)old('services', $selectedServices))) checked @endif>
                                                {{ $service->name }} <em>({{ format_price($service->price) }})</em>
                                                <span></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if (count($chunks) > 1)
                                <div class="col-md-6">
                                    @foreach($chunks[1] as $service)
                                        <div class="form-group mb-20 custom-checkbox">
                                            <label for="service_{{ $service->id }}">
                                                <input type="checkbox" class="service-item" id="service_{{ $service->id }}" name="services[{{ $service->id }}]" value="{{ $service->id }}" @if (in_array($service->id, (array)old('services', $selectedServices))) checked @endif>
                                                {{ $service->name }} <em>({{ format_price($service->price) }})</em>
                                                <span></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <h3 class="mb-20">{{ __('Your Information') }}</h3>
                    <div class="room-booking-form p-0">

                        <p class="mb-20">{{ __('Required fields are followed by *') }}</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="txt-first-name">{{ __('First Name') }} <span class="required">*</span></label>
                                    <input type="text" name="first_name" id="txt-first-name" class="form-control" required value="{{ old('first_name', $customer) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="txt-last-name">{{ __('Last Name') }} <span class="required">*</span></label>
                                    <input type="text" name="last_name" id="txt-last-name" class="form-control" required value="{{ old('last_name', $customer) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="txt-email">{{ __('Email') }} <span class="required">*</span></label>
                                    <input type="email" name="email" id="txt-email" class="form-control" required value="{{ old('email', $customer) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="txt-phone">{{ __('Phone') }} <span class="required">*</span></label>
                                    <input type="text" name="phone" id="txt-phone" class="form-control" required value="{{ old('phone', $customer) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="txt-country">{{ __('Country') }}</label>
                                    <input type="text" name="country" id="txt-country" class="form-control" value="{{ old('country', $customer) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="txt-country">{{ __('State / Province') }}</label>
                                    <input type="text" name="state" id="txt-state" class="form-control" value="{{ old('state', $customer) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="txt-city">{{ __('City') }}</label>
                                    <input type="text" name="city" id="txt-city" class="form-control" value="{{ old('city', $customer) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="txt-address">{{ __('Address') }}</label>
                                    <input type="text" name="address" id="txt-address" class="form-control" value="{{ old('address', $customer) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="txt-zip">{{ __('Postal / Zip code') }}</label>
                                    <input type="text" name="zip" id="txt-zip" class="form-control" value="{{ old('zip', $customer) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group left-icon mb-20">
                                    <label for="arrival_time">{{ __('Arrival Time') }}</label>
                                    <select name="arrival_time" id="arrival_time" class="form-select">
                                        <option>{{ __('I do not know') }}</option>
                                        <option>12:00 - 1:00 {{ __('AM') }}</option>
                                        <option>1:00 - 2:00 {{ __('AM') }}</option>
                                        <option>2:00 - 3:00 {{ __('AM') }}</option>
                                        <option>3:00 - 4:00 {{ __('AM') }}</option>
                                        <option>4:00 - 5:00 {{ __('AM') }}</option>
                                        <option>5:00 - 6:00 {{ __('AM') }}</option>
                                        <option>6:00 - 7:00 {{ __('AM') }}</option>
                                        <option>7:00 - 8:00 {{ __('AM') }}</option>
                                        <option>8:00 - 9:00 {{ __('AM') }}</option>
                                        <option>9:00 - 10:00 {{ __('AM') }}</option>
                                        <option>10:00 - 11:00 {{ __('AM') }}</option>
                                        <option>11:00 - 12:00 {{ __('AM') }}</option>
                                        <option>12:00 - 1:00 {{ __('PM') }}</option>
                                        <option>1:00 - 2:00 {{ __('PM') }}</option>
                                        <option>2:00 - 3:00 {{ __('PM') }}</option>
                                        <option>3:00 - 4:00 {{ __('PM') }}</option>
                                        <option>4:00 - 5:00 {{ __('PM') }}</option>
                                        <option>5:00 - 6:00 {{ __('PM') }}</option>
                                        <option>6:00 - 7:00 {{ __('PM') }}</option>
                                        <option>7:00 - 8:00 {{ __('PM') }}</option>
                                        <option>8:00 - 9:00 {{ __('PM') }}</option>
                                        <option>9:00 - 10:00 {{ __('PM') }}</option>
                                        <option>10:00 - 11:00 {{ __('PM') }}</option>
                                        <option>11:00 - 12:00 {{ __('PM') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if(! $customer->id)
                            <div class="create-customer">
                                <div class="row">
                                    <div class="form-group mb-20 custom-checkbox d-block">
                                        <label for="register-customer" class="w-100">
                                            <input type="checkbox" id="register-customer" name="register_customer" value="1" > {{ __('Register an account with above information?') }}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row d-none form-create-customer-password">
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <label for="password">{{ __('Password') }}</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-20">
                                            <label for="password_confirm">{{ __('Password confirm') }}</label>
                                            <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group mb-20">
                            <label for="requests">{{ __('Requests') }}</label>
                            <textarea name="requests" rows="3" class="form-control" id="requests" placeholder="{{ __('Write Something') }}...">{{ old('requests') }}</textarea>
                        </div>

                        @include('plugins/hotel::coupons.partials.form')

                        @if (is_plugin_active('payment') && ($defaultPaymentMethod = PaymentMethods::getDefaultMethod()) && get_payment_setting('status', $defaultPaymentMethod))
                            <div class="form-group mb-20">
                                <label for="requests">{{ __('Payment method') }}</label>
                                <ul class="list-group list_payment_method">
                                    {!! apply_filters(PAYMENT_FILTER_ADDITIONAL_PAYMENT_METHODS, null, [
                                        'amount' => $total,
                                        'currency' => strtoupper(get_application_currency()->title),
                                        'name' => $room->name,
                                        'selected' => PaymentMethods::getSelectedMethod(),
                                        'default' => $defaultPaymentMethod,
                                        'selecting' => PaymentMethods::getSelectingMethod(),
                                    ]) !!}

                                    {!! PaymentMethods::render() !!}
                                </ul>
                            </div>
                        @endif

                        {!! apply_filters('form_extra_fields_render', null) !!}

                        <div class="form-group mb-20 custom-checkbox d-block">
                            <label for="terms_conditions" class="w-100">
                                <input type="checkbox" id="terms_conditions" name="terms_conditions" value="1" @if (old('terms_conditions') == 1) checked @endif> {{ __('Terms & conditions *') }}
                                <span></span>
                            </label>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-filled payment-checkout-btn" data-processing-text="{{ __('Processing. Please wait...') }}" data-error-header="{{ __('Error') }}">{{ __('Checkout') }}</button>
                        </div>
                    </div>
                </form>

                @if ($hotelRules = theme_option('hotel_rules'))
                    <div class="widget-content mb-50 hotel-rules shadow-block">
                        <h3 class="mb-20">{{ __('Hotel rules') }}</h3>
                        {!! BaseHelper::clean($hotelRules) !!}
                    </div>
                @endif

                @if ( $cancellation = theme_option('cancellation'))
                    <div class="widget-content mb-50 shadow-block">
                        <h3 class="mb-20">{{ __('Cancellation') }}</h3>
                        {!! BaseHelper::clean($cancellation) !!}
                    </div>
                @endif
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 sidebar">
                <aside>
                    <div class="wrap">
                        <img src="{{ RvMedia::getImageUrl($room->image, default: RvMedia::getDefaultImage()) }}" alt="{{ $room->name }}">

                        <div class="room-information">
                            <span>{{ $room->name  }}</span>
                        </div>
                    </div>
                    <div class="form-information">
                        <p class="text-center">{{ __('YOUR RESERVATION') }}</p>
                        <div>
                            <p>{{ __('Check-In') }}: {{ $startDate->translatedFormat('l, d M, Y') }}</p>
                            <p>{{ __('Check-Out') }}: {{ $endDate->translatedFormat('l, d M, Y') }}</p>
                            <p>{{ __('Number of rooms') }}: {{ $rooms }}</p>
                            <p>{{ __('Number of adults') }}: {{ $adults }}</p>
                            <p>{{ __('Number of children') }}: {{ $children }}</p>
                            <p>{{ __('Price') }}: <span class="amount-text">{{ format_price($amount) }}</span></p>
                            <p>{{ __('Discount') }}: <span class="discount-text">{{ format_price($couponAmount) }}</span></p>
                            <p>{{ __('Tax') }}: <span class="tax-text">{{ format_price($taxAmount) }}</span></p>
                        </div>
                    </div>
                    <div class="text-center footer">
                        <p>{{ __('Total') }}: <span class="total-amount-text">{{ format_price($total) }}</span></p>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@if (is_plugin_active('payment'))
    {!! apply_filters(PAYMENT_FILTER_FOOTER_ASSETS, null) !!}

    @php
        Theme::asset()->container('footer')
        ->add('js-validation', 'vendor/core/core/js-validation/js/js-validation.js', ['jquery'])
        ->writeContent('checkout-validator', JsValidator::formRequest(Botble\Hotel\Http\Requests\CheckoutRequest::class))
    @endphp
@endif
