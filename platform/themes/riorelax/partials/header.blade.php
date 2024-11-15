@php($fullWidth = $fullWidth ?? false)

<div @if(theme_option('header_sticky_enabled', 'yes') == 'yes') id="header-sticky" @endif class="menu-area">
    <div @class(['container' => ! $fullWidth, 'container-fluid' => $fullWidth])>
        <div class="second-menu">
            <div class="row align-items-center">
                <div class="col-8 col-md-4 col-lg-2 col-xl-2">
                    @if ($logo = theme_option('logo'))
                        <div class="logo">
                            <a href="{{ route('public.index') }}"><img src="{{ RvMedia::getImageUrl($logo) }}" alt="{{ theme_option('site_name') }}"></a>
                        </div>
                    @endif
                </div>
                <div @class(['col-4 col-md-8 ', 'col-lg-8 col-xl-8' => ! $fullWidth, 'col-lg-9 col-xl-9' => $fullWidth])>
                    <div class="main-menu text-center">
                        <nav id="mobile-menu">
                            {!! Menu::renderMenuLocation('main-menu', [
                                'options' => ['class' => 'main-menu'],
                                'view' => 'main-menu',
                            ]) !!}
                        </nav>
                    </div>
                    <button class="navbar-toggler text-white float-end d-lg-none btn btn-toggle-menu-mobile" type="button" data-bs-toggle="collapse" data-bs-target="#menu-mobile-nav" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-list"></i>
                    </button>
                </div>

                @if ($fullWidth)
                    <div class="d-none d-lg-block col-xl-1 col-lg-1 text-end">
                        <div class="search-top">
                            <ul>
                                <li><div class="bar-humburger"><a href="#" class="menu-tigger"><i class="fal fa-bars"></i></a></div></li>
                            </ul>
                        </div>
                    </div>
                @elseif (($buttonLabel = theme_option('header_button_label')) && ($buttonUrl = theme_option('header_button_url')))
                    <div class="d-none d-lg-block col-xl-2 col-lg-2">
                        <a href="{{ $buttonUrl }}" class="top-btn mt-10 mb-10">{!! BaseHelper::clean($buttonLabel) !!}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {!! Theme::partial('menu-mobile-collapse') !!}
</div>

@if ($fullWidth)
    {!!  Theme::partial('offcanvas-menu') !!}
@endif
