@extends(Theme::getThemeNamespace('layouts.base'))

@section('main')
    <div class="container-fluid side-menu">
        {!! Theme::partial('menu-mobile-collapse') !!}

        <div class="row">
            <div class="col-xl-2 col-lg-3 pl-0 pr-0">
                <header class="header-slidemenu">
                    <div class="d-flex align-items-center justify-between">
                        @if ($logo = theme_option('logo'))
                            <div class="logo mb-100">
                                <a href="{{ route('public.index') }}"><img src="{{ RvMedia::getImageUrl($logo) }}" alt="{{ theme_option('site_name') }}"></a>
                            </div>
                        @endif

                        <div class="ms-auto">
                            <button class="navbar-toggler text-white float-end d-lg-none btn btn-toggle-menu-mobile" type="button" data-bs-toggle="collapse" data-bs-target="#menu-mobile-nav" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa fa-list"></i>
                            </button>
                        </div>
                    </div>

                    <div class="main-menu slide-out">
                        @if (auth('customer')->check())
                            <ul class="main-menu">
                                <li>
                                    <a href="{{ route('customer.overview') }}" target="_self">
                                        {{ __('Hi, :name', ['name' =>  auth('customer')->user()->name]) }}
                                    </a>
                                </li>
                            </ul>
                        @endif
                        <nav id="mobile-menu">
                            {!! Menu::renderMenuLocation('main-menu', [
                               'options' => ['class' => 'main-menu'],
                               'view' => 'main-menu',
                           ]) !!}
                            @if (! auth('customer')->check())
                                <ul class="main-menu">
                                    <li>
                                        <a href="{{ route('customer.login') }}" target="_self">
                                            {{ __('Login') }}
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </nav>
                    </div>
                    @if ($socialLinks = json_decode(theme_option('social_links')))
                        <div class="footer-social">
                            @foreach($socialLinks as $social)
                                @php($social = collect($social)->pluck('value', 'key'))
                                <a target="_blank" href="{{ $social->get('url') }}" title="{{ $social->get('name') }}"><i class="{{ $social->get('social-icon') }}"></i></a>
                            @endforeach
                        </div>
                    @endif
                </header>
            </div>
            <div class="col-xl-10 col-lg-9 pl-0 pr-0">
                {!! Theme::content() !!}
            </div>
        </div>
    </div>
@endsection


