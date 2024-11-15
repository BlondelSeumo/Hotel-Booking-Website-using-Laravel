@php
    Theme::set('pageTitle', SeoHelper::getTitle());
@endphp

<section class="about-area about-p pt-60 pb-60 p-relative fix">
    <div class="container">
        <div class="row flex-row-reverse justify-content-center align-items-center">
            @if($backgroundImage = theme_option('authentication_reset_password_background_image'))
                <div class="col-lg-6 col-md-6">
                    <div class="booking-img">
                        <img src="{{ RvMedia::getImageURL($backgroundImage) }}" alt="{{ __('Reset password') }}" />
                    </div>
                </div>
            @endif
            <div class="col-md-6 col-lg-6">
                <h1>{{ __('Reset password') }}</h1>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('customer.password.reset.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}" />

                            <div class="form-field-wrapper form-group mb-20">
                                <div class="col-lg-12 col-md-12">
                                    <div class="input-md form-full-width contact-field p-relative c-name {{ $errors->has('email') ? ' is-invalid' : '' }}">
                                        <label class="custom-authentication-label" for="email">
                                            <span>{{ __('Email Address') }}</span>
                                        </label>
                                        <input class="custom-authentication-input" type="email" id="email" name="email" placeholder="{{ __('Enter your email address') }}" value="{{ old('email', $email) }}" required />
                                    </div>

                                    {!! Form::error('email', $errors) !!}
                                </div>
                            </div>

                            <div class="form-field-wrapper form-group mb-20">
                                <div class="col-lg-12 col-md-12">
                                    <div class="input-md form-full-width contact-field p-relative c-name {{ $errors->has('password') ? ' is-invalid' : '' }}">
                                        <label class="custom-authentication-label" for="password">
                                            <span>{{ __('New Password') }}</span>
                                        </label>
                                        <input class="custom-authentication-input" type="password" id="password" name="password" placeholder="{{ __('Enter your new password') }}" required />
                                    </div>

                                    {!! Form::error('password', $errors) !!}
                                </div>
                            </div>

                            <div class="form-field-wrapper form-group">
                                <div class="col-lg-12 col-md-12">
                                    <div class="input-md form-full-width contact-field p-relative c-name mb-20">
                                        <label class="custom-authentication-label" for="password_confirmation">
                                            <span>{{ __('New Password Confirmation') }}</span>
                                        </label>
                                        <input class="custom-authentication-input" type="password" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Confirm your new password') }}" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 mt-20">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
