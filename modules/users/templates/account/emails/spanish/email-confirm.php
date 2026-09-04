@data.subject = "Confirma tu nuevo correo electrónico en $config->site->name"

Hola {{ $user->username }},

Has solicitado actualizar tu correo electrónico en {{ $config->site->name }}. Para confirmar tu nueva dirección de correo electrónico, haz clic en el enlace de abajo:

<a href="{{ $confirm_url }}">{{ $confirm_url }}</a>

Saludos cordiales,
El equipo de {{ $config->site->name }}