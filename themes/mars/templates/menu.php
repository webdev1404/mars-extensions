<nav>
    <ul>
        <li><a href="{{ $url.root }}">{{ theme:menu.homepage }}</a></li>
        @if ($modules.isEnabled('users'))
        <li><a href="{{ $url.route('users.login') }}">{{ theme:menu.login }}</a></li>
        <li><a href="{{ $url.route('users.register') }}">{{ theme:menu.register }}</a></li>
        @endif
    </ul>
</nav>