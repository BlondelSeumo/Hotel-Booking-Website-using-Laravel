@if (is_plugin_active('blog'))
    @php
        $limit = (int) Arr::get($config, 'limit');
        $posts = match (Arr::get($config, 'type')) {
            'recent' => get_recent_posts($limit),
            default => get_popular_posts($limit),
        };
    @endphp

    <section id="recent-posts-4" class="custom-blog-post-sidebar">
        @if ($title = $config['title'])
            <h2 class="widget-title">{{ $title }}</h2>
        @endif
        <ul>
            @foreach($posts as $post)
                <li>
                    <div class="custom-blog-post-name">
                        <a href="{{ $post->url }}">{{ $post->name }}</a>
                    </div>
                    <div>
                        <small>{{ $post->created_at->translatedFormat('M d, Y') }}</small>
                    </div>
                </li>
            @endforeach
        </ul>
    </section>
@endif


