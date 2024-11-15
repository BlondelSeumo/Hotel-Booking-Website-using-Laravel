<div class="offcanvas-menu">
    <span class="menu-close"><i class="fal fa-times"></i></span>
    @if (is_plugin_active('hotel'))
        <form action="{{ route('public.rooms') }}" role="search" method="get" class="search-form">
            <input class="input-search" type="text" name="q" value="{{ old('q', request()->query('q')) }}" placeholder="{{ __('Enter keyword') }}..."  />
            <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    @endif

    <div class="menu-one-page-menu-container">
        {!! Menu::renderMenuLocation('sidebar-menu', [
            'options' => ['class' => 'menu', 'id' => 'menu-one-page-menu-2'],
            'view' => 'sidebar-menu',
        ]) !!}
    </div>

    <div class="menu-one-page-menu-container mt-n20">
        <ul id="menu-one-page-menu-1" class="menu">
            <li class="menu-item menu-item-type-custom menu-item-object-custom">
                @if (auth('customer')->check())
                    <a class="customer-name-canvas" href="{{ route('customer.overview') }}">
                        <img src="{{ auth('customer')->user()->avatar_url }}" class="rounded-circle text-white customer-avatar-header" title="{{ auth('customer')->user()->name }}" width="16" alt="{{ auth('customer')->user()->name }}">
                        <span class="customer-name ms-1">{{ auth('customer')->user()->name }}</span>
                    </a>
                @else
                    <a href="{{ route('customer.login') }}">
                        <span>{{ __('Login') }}</span>
                        <i class="fa fa-sign-in-alt"></i>
                    </a>
                @endif
            </li>
        </ul>
    </div>

    <div class="menu-one-page-menu-container mt-100">
        <ul id="menu-one-page-menu-1" class="menu">
            @if ($hotline = theme_option('hotline'))
                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                    <a href="tel:{{ $hotline }}"><span>{{ $hotline }}</span></a>
                </li>
            @endif

            @if ($email = theme_option('email'))
                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                    <a href="mailto:{{ $email }}"><span>{{ $email }}</span></a>
                </li>
            @endif
        </ul>
    </div>
</div>
<div class="offcanvas-overly"></div>
