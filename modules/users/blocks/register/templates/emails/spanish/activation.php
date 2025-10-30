@data("subject", "Activa tu cuenta en $config.site_name")
Saludos {{ $user.username }},

Gracias por registrarte en {{ $config.site_name }}. Para activar tu cuenta, por favor haz clic en el siguiente enlace:

<a href="{{ $activation_link }}">{{ $activation_link }}</a>

Si no te registraste para una cuenta, por favor ignora este correo electrónico.

Saludos cordiales,  
El equipo de {{ $config.site_name }}