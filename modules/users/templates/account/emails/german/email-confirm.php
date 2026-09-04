@data.subject = "Bestätigen Sie Ihre neue E-Mail auf $config->site->name"

Hallo {{ $user->username }},

Sie haben angefordert, Ihre E-Mail auf {{ $config->site->name }} zu aktualisieren. Um Ihre neue E-Mail-Adresse zu bestätigen, klicken Sie bitte auf den untenstehenden Link:

<a href="{{ $confirm_url }}">{{ $confirm_url }}</a>

Beste Grüße,
Das {{ $config->site->name }} Team