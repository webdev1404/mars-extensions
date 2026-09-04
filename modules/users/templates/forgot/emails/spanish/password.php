@data.subject = "Restablecer contraseña para $config->site->name"
Hola {{ $user->username }},

Hemos recibido una solicitud para restablecer la contraseña de tu cuenta.

Para restablecer tu contraseña, haz clic en el siguiente enlace:

<a href="{{ $reset_url }}">{{ $reset_url }}</a>

Si no solicitaste este correo, puedes ignorarlo sin problemas. No se han realizado cambios en tu cuenta.

Saludos cordiales,
El equipo de {{ $config->site->name }}
