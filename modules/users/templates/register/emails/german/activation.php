@data("subject", "Aktivieren Sie Ihr Konto auf $config.site.name")
Grüße {{ $user.username }},

Vielen Dank für die Registrierung auf {{ $config.site.name }}. Um Ihr Konto zu aktivieren, klicken Sie bitte auf den Link unten:

<a href="{{ $activation_link }}">{{ $activation_link }}</a>

Falls Sie sich nicht für ein Konto registriert haben, ignorieren Sie bitte diese E-Mail.

Mit freundlichen Grüßen,
Das {{ $config.site.name }} Team