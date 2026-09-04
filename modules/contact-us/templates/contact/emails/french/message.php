@data.subject = "Nouveau message de contact sur $config->site->name"

Bonjour,

Un nouveau message de contact a été reçu sur {{ $config->site->name }}. Voici les détails :

Nom : {{ $message->name }}&nbsp;
Email : <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>&nbsp;
@if ($message->phone)
Téléphone : <a href="tel:{{ $message->phone }}">{{ $message->phone }}</a>&nbsp;
@endif
Message :
{{ $message->message }}&nbsp;