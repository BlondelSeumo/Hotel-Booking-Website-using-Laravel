<ul {!! BaseHelper::clean($options) !!}>
    @foreach ($menu_nodes as $row)
        <li class="nav-item">
            <a href="{{ $row->url }}"
               @class(['nav-link collapsed', 'has-sub' => $row->has_child, 'active' => $row->active])
               target="{{ $row->target }}"
               @if($row->has_child)
                   data-bs-toggle="collapse"
                   data-bs-target="#menu-collapse-{{ $row->id }}"
                   aria-expanded="false"
                   aria-controls="menu-collapse-{{ $row->id }}"
               @endif
            >{{ $row->title }}</a>
        </li>

        @if ($row->has_child)
            <div class="collapse" id="menu-collapse-{{ $row->id }}">
                {!! Menu::renderMenuLocation('main-menu', [
                    'menu_nodes' => $row->child,
                    'view' => 'menu-mobile',
                    'options' => ['class' => 'navbar-nav me-auto mb-2 mb-lg-0 ms-3'],
                ]) !!}
            </div>
        @endif
    @endforeach
</ul>
