@data.subject = "Activa tu cuenta en $config->site->name"

Hola {{ $user->username }},

Gracias por registrarte en {{ $config->site->name }}. Para activar tu cuenta, por favor haz clic en el enlace de abajo:

<a href="{{ $activation_url }}">{{ $activation_url }}</a>

Si no te registraste en una cuenta, por favor ignora este correo electrónico.

Saludos cordiales,
El equipo de {{ $config->site->name }}