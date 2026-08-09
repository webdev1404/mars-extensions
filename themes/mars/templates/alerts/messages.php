<div class="system-alerts system-alerts-messages">
    <ul>
    @foreach ($messages as $message)
    <li>{! $message['text'] | nl2br !}</li>
    @endforeach
    </ul>
</div>