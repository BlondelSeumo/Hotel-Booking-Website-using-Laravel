@extends(Theme::getThemeNamespace('layouts.base'))

@section('main')

    <header class="header-area header-three">
        @if (theme_option('header_top_enabled', true))
            {!! Theme::partial('header-top') !!}
        @endif

        {!! Theme::partial('header') !!}
    </header>

    @if (Theme::get('breadcrumb', true))
    {!! Theme::partial('breadcrumbs') !!}
    @endif

    <section class="inner-blog pt-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    {!! Theme::content() !!}
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4">
                    <aside class="sidebar-widget">
                        {!! dynamic_sidebar('blog_sidebar') !!}
                    </aside>
                </div>
            </div>
        </div>
    </section>


    {!! Theme::partial('footer') !!}
@endsection
