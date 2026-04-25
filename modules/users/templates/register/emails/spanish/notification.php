@data("subject", "Nuevo registro en $config.site.name")
Saludos,

Un nuevo usuario se ha registrado en {{ $config.site.name }}. Aquí están los detalles:

Nombre de usuario: {{ $user.username }}&nbsp;
Correo electrónico: {{ $user.email }}&nbsp;

Saludos cordiales,
El equipo de {{ $config.site.name }}