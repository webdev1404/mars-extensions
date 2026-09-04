@data.subject = "Neue Kontaktanfrage auf $config->site->name"

Hallo,

auf {{ $config->site->name }} wurde eine neue Kontaktanfrage erhalten. Hier sind die Details:

Name: {{ $message->name }}&nbsp;
E-Mail: <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>&nbsp;
@if ($message->phone)
Telefon: <a href="tel:{{ $message->phone }}">{{ $message->phone }}</a>&nbsp;
@endif
Nachricht:
{{ $message->message }}&nbsp;