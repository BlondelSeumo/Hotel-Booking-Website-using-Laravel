@php($fullWidth =  $fullWidth ?? false)

<div class="header-top second-header d-none d-md-block">
    <div @class(['container' => ! $fullWidth, 'container-fluid' => $fullWidth])>
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 d-none d-lg-block header-top-left">
                <div class="header-cta">
                    <ul>
                        @if ($openingHours = theme_option('opening_hours'))
                            <li class="opening_hours">
                                <i class="far fa-clock"></i>
                                <span>{!! BaseHelper::clean($openingHours) !!}</span>
                            </li>
                        @endif

                        @if ($phoneNumber = theme_option('hotline'))
                            <li>
                                <i class="far fa-mobile"></i>
                                <strong><a href="tel:{{ $phoneNumber }}">{{ $phoneNumber }}</a></strong>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 d-none d-lg-block text-end header-top-end">
                <div class="header-social">
                    {!! Theme::partial('language-switcher') !!}
                    {!! Theme::partial('currency-switcher') !!}
                    @if (is_plugin_active('hotel'))
                        @auth('customer')
                            <a href="{{ route('customer.overview') }}">
                                <img src="{{ auth('customer')->user()->avatar_url }}" class="rounded-circle ms-3 text-white customer-avatar-header" title="{{ auth('customer')->user()->name }}" width="16" alt="{{ auth('customer')->user()->name }}">
                                <span class="customer-name text-white ms-1 customer-name-header">{{ auth('customer')->user()->name }}</span>
                            </a>
                        @else
                            <a href="{{ route('customer.login') }}" class="ms-3">
                                <i class="fa fa-sign-in-alt"></i>
                                <span class="text-white customer-name-header ms-1">{{ __('Login') }}</span>
                            </a>
                        @endif
                    @endif
                    @if ($socialLinks = json_decode(theme_option('social_links')))
                        <span class="social-links">
                            @foreach($socialLinks as $social)
                                @php($social = collect($social)->pluck('value', 'key'))
                                <a target="_blank" href="{{ $social->get('url') }}" title="{{ $social->get('name') }}"><i class="{{ $social->get('social-icon') }}"></i></a>
                            @endforeach
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="language-switcher-mobile d-none">
    {!! Theme::partial('language-switcher-mobile') !!}
</div>

<div class="currency-switcher-mobile d-none">
    {!! Theme::partial('currency-switcher-mobile') !!}
</div>
