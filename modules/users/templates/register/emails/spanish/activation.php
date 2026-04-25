@data("subject", "Activa tu cuenta en $config.site.name")
Saludos {{ $user.username }},

Gracias por registrarte en {{ $config.site.name }}. Para activar tu cuenta, haz clic en el enlace a continuación:

<a href="{{ $activation_link }}">{{ $activation_link }}</a>

Si no te registraste en una cuenta, ignora este correo electrónico.

Saludos cordiales,
El equipo de {{ $config.site.name }}