@data("subject", "Activez votre compte sur $config.site.name")
Bonjour {{ $user.username }},

Merci de vous être inscrit sur {{ $config.site.name }}. Pour activer votre compte, veuillez cliquer sur le lien ci-dessous :

<a href="{{ $activation_link }}">{{ $activation_link }}</a>

Si vous ne vous êtes pas inscrit pour créer un compte, veuillez ignorer cet e-mail.

Cordialement,
L'équipe {{ $config.site.name }}