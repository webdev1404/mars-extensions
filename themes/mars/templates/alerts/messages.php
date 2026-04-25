<div id="messages-container">	
    @foreach ($messages as $message)
        {! $message['text'] | nl2br !}<br />
    @endforeach
</div>