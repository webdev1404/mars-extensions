<div id="errors-container">
    <ul>
    @foreach ($errors as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>