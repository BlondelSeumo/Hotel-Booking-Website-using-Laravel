@php
    $perItem = theme_option('number_of_post_per_row', 2)
@endphp

<div class="row">
    @foreach($posts as $post)
        <div @class([
            'col-12' => $perItem == 1,
            'col-lg-6' => $perItem == 2,
            'col-lg-4' => $perItem == 3,
        ])>
            {!! Theme::partial('blog.post.item', compact('post')) !!}
        </div>
    @endforeach

    @if ($posts instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
        <div class="text-center mt-30">
            {!! $posts->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
        </div>
    @endif
</div>
