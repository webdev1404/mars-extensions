@data.subject = "Tu nombre de usuario para $config->site->name"
Hola,

Hemos recibido una solicitud para recuperar el nombre de usuario asociado a esta dirección de correo electrónico.

Tu nombre de usuario es:

<strong>{{ $user->username }}</strong>

Puedes usar este nombre de usuario para <a href="{{ $url->route('users.login') }}">iniciar sesión</a> en tu cuenta.

Si no solicitaste este correo electrónico, puedes ignorarlo sin problema. No se han realizado cambios en tu cuenta.

Atentamente,
El equipo de {{ $config->site->name }}