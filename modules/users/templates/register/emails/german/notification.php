@data("subject", "Neue Registrierung auf $config.site.name")
Greetings,

Ein neuer Benutzer hat sich auf {{ $config.site.name }} registriert. Hier sind die Details:

Benutzername: {{ $user.username }}&nbsp;
E-Mail: {{ $user.email }}&nbsp;

Best regards,
Das {{ $config.site.name }} Team