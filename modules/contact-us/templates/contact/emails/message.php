@data.subject = "New contact message on $config->site->name"

Hello,

A new contact us message has been received on {{ $config->site->name }}. Here are the details:

Name: {{ $message->name }}&nbsp;
Email: <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>&nbsp;
@if ($message->phone)
Phone: <a href="tel:{{ $message->phone }}">{{ $message->phone }}</a>&nbsp;
@endif
Message: 
{{ $message->message }}&nbsp;