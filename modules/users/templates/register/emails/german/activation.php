@data.subject = "Aktiviere dein Konto auf $config->site->name"

Hallo {{ $user->username }},

Vielen Dank für deine Registrierung bei {{ $config->site->name }}. Um dein Konto zu aktivieren, klicke bitte auf den folgenden Link:

<a href="{{ $activation_url }}">{{ $activation_url }}</a>

Falls du dich nicht registriert hast, ignoriere diese E-Mail bitte.

Beste Grüße,
Das {{ $config->site->name }} Team