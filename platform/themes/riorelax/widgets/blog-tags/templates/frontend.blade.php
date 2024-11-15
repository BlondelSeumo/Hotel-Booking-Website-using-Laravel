@if (is_plugin_active('blog'))
    @php
        $limit = (int) Arr::get($config, 'limit', 10);
        $type = Arr::get($config, 'type');

        if ($limit > 0) {
            $tags = get_popular_tags($limit);
        } else {
            $tags = get_all_tags();
        }
    @endphp

    @if ($tags->count())
    <section id="tag_cloud-1" class="widget widget_tag_cloud">
        @if ($title = $config['title'])
            <h2 class="widget-title">{{ $title }}</h2>
        @endif
        <div class="tagcloud">
            @foreach($tags as $tag)
                <a href="{{ $tag->url }}" class="tag-cloud-link tag-link-28 tag-link-position-1 custom-blog-tag-sidebar" style="font-size: 8pt;" aria-label="{{ $tag->name }}">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </section>
    @endif
@endif

