@php
    $couponCode = HotelHelper::getCheckoutData('coupon_code');
    $couponAmount = HotelHelper::getCheckoutData('coupon_amount');
@endphp
<div class="order-detail-box mb-20" data-refresh-url="{{ route('coupon.refresh') }}">
    <button class="btn-link ps-0 text-decoration-none toggle-coupon-form" type="button">{{ trans('plugins/hotel::coupon.toggle_coupon_form_text') }}</button>

    <div class="card coupon-form mt-3" @style(['display: none' => ! ($couponCode && $couponAmount)])>
        <div class="card-body">
            @if ($couponCode && $couponAmount)
                <div class="d-flex align-items-center justify-content-between alert alert-success mb-0 w-100">
                    <span>{{ __('Coupon code: :code', ['code' => $couponCode]) }}</span>
                    <input name="coupon_hidden" type="hidden" value="{{ ! empty($couponCode) }}" />

                    <button class="btn btn-link text-decoration-none remove-coupon-code" data-url="{{ route('coupon.remove') }}" type="button">
                        <i class="fa fa-trash"></i>
                        {{ __('Remove') }}
                    </button>
                </div>
            @else
                <div class="form-group">
                    <label for="coupon_code" class="form-label">{{ trans('plugins/hotel::coupon.coupon_code') }}</label>
                    <div class="input-group">
                        <input type="text" id="coupon_code" name="coupon_code" class="form-control" placeholder="{{ trans('plugins/hotel::coupon.coupon_code_placeholder') }}" value="{{ BaseHelper::clean(old('coupon_code')) }}">
                        <button class="btn btn-primary apply-coupon-code" data-url="{{ route('coupon.apply') }}" type="button">
                            {{ trans('plugins/hotel::coupon.apply_coupon_code') }}
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
