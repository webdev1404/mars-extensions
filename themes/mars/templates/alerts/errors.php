<div class="system-alerts system-alerts-errors">
    <ul>
    @foreach ($errors as $error)
    <li>{! $error['text'] | nl2br !}</li>
    @endforeach
    </ul>
</div>