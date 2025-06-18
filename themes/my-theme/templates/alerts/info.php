<div id="notifications-container">
    <ul>
    @foreach ($info as $notification)
        <li>{{ $notification }}</li>
    @endforeach
    </ul>
</div>