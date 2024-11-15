<ul {!! BaseHelper::clean($options) !!}>
    @foreach($menu_nodes->loadMissing('metadata') as $item)
        <li>
            <a target="{{ $item->target }}" class="font-sm color-grey-200" href="{{ url($item->url) }}">{{ $item->title }}</a>
        </li>
    @endforeach
</ul>
