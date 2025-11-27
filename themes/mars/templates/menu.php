<nav>
    <ul>
        <li><a href="{{ $url.root }}">{{ theme.menu.homepage }}</a></li>
        @if ($modules.isEnabled('users'))
        <li><a href="{{ $url.route('register') }}">{{ theme.menu.register }}</a></li>
        @endif
    </ul>
</nav>