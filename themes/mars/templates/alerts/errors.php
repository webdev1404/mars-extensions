<div id="errors-container">
    <ul>
    @foreach ($errors as $error)
    <li>{! $error['text'] | nl2br !}</li>
    @endforeach
    </ul>
</div>