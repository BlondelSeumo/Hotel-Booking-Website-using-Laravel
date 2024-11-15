@if (is_plugin_active('blog'))
    <section id="custom_html-5" class="widget_text widget widget_custom_html">
        <h2 class="widget-title">Follow Us</h2>
        <div class="textwidget custom-html-widget">
            <div class="widget-social">
                @foreach(range(1, 5) as $i)
                    @if(Arr::get($config, "link_$i") && Arr::get($config, "icon_$i"))
                        <a target="_blank" href="{{ Arr::get($config, "link_$i") }}">
                            <i class="{{ Arr::get($config, "icon_$i") }}"></i>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endif
