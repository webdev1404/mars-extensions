@data.subject = "Nuovo messaggio di contatto su $config->site->name"

Ciao,

Un nuovo messaggio di contatto è stato ricevuto su {{ $config->site->name }}. Ecco i dettagli:

Nome: {{ $message->name }}&nbsp;
Email: <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>&nbsp;
@if ($message->phone)
Telefono: <a href="tel:{{ $message->phone }}">{{ $message->phone }}</a>&nbsp;
@endif
Messaggio:
{{ $message->message }}&nbsp;