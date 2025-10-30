@data("subject", "Aktivieren Sie Ihr Konto auf $config.site_name")
Hallo {{ $user.username }},

Vielen Dank für Ihre Registrierung bei {{ $config.site_name }}. Um Ihr Konto zu aktivieren, klicken Sie bitte auf den folgenden Link:

<a href="{{ $activation_link }}">{{ $activation_link }}</a>

Falls Sie sich nicht für ein Konto registriert haben, ignorieren Sie bitte diese E-Mail.

Mit freundlichen Grüßen,
Das {{ $config.site_name }} Team