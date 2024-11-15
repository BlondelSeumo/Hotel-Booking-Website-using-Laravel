@php
    SeoHelper::setTitle(__('404 - Not found'));
    Theme::fireEventGlobalAssets();
    $image = theme_option('404_page_image') ?
        RvMedia::getImageUrl(theme_option('404_page_image')) :
        Theme::asset()->url('/images/404.png');
@endphp

@extends(Theme::getThemeNamespace('layouts.base'))
@section('main')
    <header class="header-area header-three">
        @if (theme_option('header_top_enabled', true))
            {!! Theme::partial('header-top', ['fullWidth' => true]) !!}
        @endif

        {!! Theme::partial('header', ['fullWidth' => false]) !!}
    </header>
    <section class="error-page">
        <div class="pt-160 pb-60 text-center d-sm-flex d-block container center align-items-center">
            <div>
                <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ __('404 Not Found') }}"/>
            </div>
            <div class="ms-0 ms-sm-5">
                <h2>{{ __('Oops, nothing to see here') }}:</h2>
                <ul>
                    <li>{{ __("Unfortunately, we couldn't find what you were looking for or the page no longer exists.") }}</li>
                </ul>
                <br>
                <a href="{{ route('public.index') }}">
                    <i class="fal fa-long-arrow-left me-1"></i>
                    {{ __('Back to Homepage') }}
                </a>
            </div>
        </div>
    </section>

    {!! Theme::partial('footer') !!}
@endsection
