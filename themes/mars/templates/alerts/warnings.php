<div id="warnings-container">
    <ul>
    @foreach ($warnings as $warning)
        <li>{! $warning['text'] | nl2br !}</li>
    @endforeach
    </ul>
</div>