<div class="system-alerts system-alerts-warnings">
    <ul>
    @foreach ($warnings as $warning)
        <li>{! $warning['text'] | nl2br !}</li>
    @endforeach
    </ul>
</div>