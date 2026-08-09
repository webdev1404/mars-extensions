<div class="system-alerts system-alerts-info">
    <ul>
    @foreach ($info as $notification)
        <li>{! $notification['text'] | nl2br !}</li>
    @endforeach
    </ul>
</div>