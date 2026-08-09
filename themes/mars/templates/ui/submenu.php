<ul class="submenu">
    @foreach ($items as $id => $item)
        <li class="submenu-item submenu-item-{{ $id | id }}">
            <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>

            @if ($item['items'])
                @include('submenu', ['items' => $item['items'], 'type' => $type])
            @endif
        </li>
    @endforeach
</ul>
