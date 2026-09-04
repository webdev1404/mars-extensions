@data.subject = "Nuevo mensaje de contacto en $config->site->name"

Hola,

Se ha recibido un nuevo mensaje de contacto en {{ $config->site->name }}. Aquí están los detalles:

Nombre: {{ $message->name }}&nbsp;
Correo electrónico: <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>&nbsp;
@if ($message->phone)
Teléfono: <a href="tel:{{ $message->phone }}">{{ $message->phone }}</a>&nbsp;
@endif
Mensaje:
{{ $message->message }}&nbsp;