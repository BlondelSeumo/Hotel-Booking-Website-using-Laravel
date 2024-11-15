@if (is_plugin_active('blog'))
    <section id="search-3" class="widget widget_search">
        @if ($title = $config['title'])
            <h2 class="widget-title">{{ $title }}</h2>
        @endif
        <form role="search" method="get" class="search-form custom-search-form" action="{{ route('public.search') }}">
            <label>
                <span class="screen-reader-text">Search for:</span>
                <input type="search" class="search-field" placeholder="{{ __('Search...') }}" value="{{ BaseHelper::stringify(request()->query('q')) }}" name="q" required/>
            </label>
            <button type="submit" class="btn btn-custom">{{ __('Search') }}</button>
        </form>
    </section>
@endif
