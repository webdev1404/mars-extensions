@data("subject", "Activez votre compte sur $config.site_name")
Bonjour {{ $user.username }},

Merci de vous être inscrit sur {{ $config.site_name }}. Pour activer votre compte, veuillez cliquer sur le lien ci-dessous :

<a href="{{ $activation_link }}">{{ $activation_link }}</a>

Si vous n'avez pas créé de compte, veuillez ignorer cet email.

Cordialement,
L'équipe de {{ $config.site_name }}