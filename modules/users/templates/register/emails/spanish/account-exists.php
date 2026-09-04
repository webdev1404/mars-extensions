@data.subject = "Intento de registro de cuenta detectado en $config->site->name"

Hola {{ $user->username }},

Alguien (posiblemente tú) intentó registrarse con esta dirección de correo electrónico. Si no fuiste tú, no es necesario que hagas nada – tu cuenta está segura.

Si olvidaste tu contraseña, utiliza este <a href="{{ $url->route('users.forgot.password') }}">enlace para restablecer</a>.

Saludos cordiales,
El equipo de {{ $config->site->name }}