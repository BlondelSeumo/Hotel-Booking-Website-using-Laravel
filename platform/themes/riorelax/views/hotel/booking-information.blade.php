@php
    Theme::set('pageTitle', __('Booking information'));
    Theme::layout('full-width');
@endphp

<section class="booking-information-page">
    <div class="pt-60 pb-60">
        <div class="container">
            <div class="justify-content-center">
                <div class="booking-form-body room-details booking-information">
                    <h3 class="mb-20">{{ __('Your booking information') }}</h3>
                    <br>
                    @include('plugins/hotel::booking-info', ['booking' => $booking, 'route' => 'customer.generate-invoice'])
                </div>
            </div>
        </div>
    </div>
</section>
