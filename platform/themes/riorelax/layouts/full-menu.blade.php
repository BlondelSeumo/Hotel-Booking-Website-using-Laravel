@extends(Theme::getThemeNamespace('layouts.base'))

@section('main')
    <header class="header-area header-three">
        @if (theme_option('header_top_enabled', true))
            {!! Theme::partial('header-top', ['fullWidth' => true]) !!}
        @endif

        {!! Theme::partial('header', ['fullWidth' => true]) !!}
    </header>

    @if (Theme::get('breadcrumb', true))
    {!! Theme::partial('breadcrumbs') !!}
    @endif

    {!! Theme::content() !!}

    {!! Theme::partial('footer') !!}
@endsection
