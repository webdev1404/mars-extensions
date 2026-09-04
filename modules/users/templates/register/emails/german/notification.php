@data.subject = "Neue Registrierung auf $config->site->name"

Hallo,

Ein neuer Benutzer hat sich auf {{ $config->site->name }} registriert. Hier sind die Details:

Benutzername: {{ $user->username }}&nbsp;
E-Mail: {{ $user->email }}&nbsp;

Mit freundlichen Grüßen,
Das {{ $config->site->name }} Team