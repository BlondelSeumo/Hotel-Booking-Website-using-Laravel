<ul {!! BaseHelper::clean($options) !!}>
    @foreach ($menu_nodes as $row)
        <li @class(['has-sub' => $row->has_child, $row->css_class])>
            <a @class(['active' => $row->active]) href="{{ $row->url }}" target="{{ $row->target }}">
                @if($iconImage = $row->getMetaData('icon_image', true))
                    <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="{{ $row->title }}" loading="lazy"/>
                @elseif($row->icon_font)
                    <i class="{{ trim($row->icon_font) }}"></i>
                @endif

                {{ $row->title }}
            </a>
            @if($row->has_child)
                {!! Menu::renderMenuLocation('main-menu', [
                    'menu_nodes' => $row->child,
                    'view' => 'main-menu',
                    'options' => ['class' => 'sub-menu'],
                ]) !!}
            @endif
        </li>
    @endforeach
</ul>
