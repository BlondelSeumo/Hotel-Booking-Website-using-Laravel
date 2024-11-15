<ul {!! BaseHelper::clean($options) !!}>
    @foreach ($menu_nodes as $row)
        <li class="menu-item menu-item-type-custom menu-item-object-custom">
            <a href="{{ $row->url }}" target="{{ $row->target }}">{{ $row->title }}</a>
        </li>
    @endforeach
</ul>
