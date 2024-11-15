@if ($posts->isNotEmpty())
    {!! Theme::partial('blog.posts', compact('posts')) !!}
@else
    <h1 class="text-center">{{ __('Ops! No results found') }}</h1>
    <p class="text-center">
        {{ __('We couldn’t find what you searched for. Try searching again or') }}
        <a class="link-primary custom-link" href="{{ route('public.single', 'blog') }}">{{ __('Back here') }}</a>
    </p>
@endif
