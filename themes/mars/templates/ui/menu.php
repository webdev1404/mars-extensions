<ul id="menu-{{ $type }}" class="menu menu-{{ $type }}">
    @foreach ($items as $id => $item)
        <li class="menu-item menu-item-{{ $id | id }}">
            <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>

            @if ($item['items'])
                @include('submenu', ['items' => $item['items'], 'type' => $type])
            @endif
        </li>
    @endforeach
</ul>