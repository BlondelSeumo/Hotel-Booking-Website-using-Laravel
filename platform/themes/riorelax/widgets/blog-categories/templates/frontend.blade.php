@if (is_plugin_active('blog'))
    @php
        $limit = (int) Arr::get($config, 'limit', 10);
        $type = Arr::get($config, 'type');

        if ($limit > 0) {
            $categories = get_popular_categories($limit);
        } else {
            $categories = get_all_categories();
        }
    @endphp

    @if ($categories->count())
        <section id="categories-1" class="widget widget_categories">
            @if ($title = $config['title'])
                <h2 class="widget-title">{{ $title }}</h2>
            @endif
            <ul>
                @foreach($categories as $category)
                    <li class="cat-item cat-item-16">
                        <a href="{{ $category->url }}">{{ $category->name }}</a>
                        <span class="float-end">{{ number_format($category->posts_count) }}</span>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif
@endif
