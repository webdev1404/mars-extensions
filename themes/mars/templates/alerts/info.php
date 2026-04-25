<div id="notifications-container">
    <ul>
    @foreach ($info as $notification)
        <li>{! $notification['text'] | nl2br !}</li>
    @endforeach
    </ul>
</div>