<?php

return [
    'fatal.error' => 'Ha ocurrido un error fatal. Por favor, contacte al administrador.',
    'mail.send' => 'Error al enviar el correo: {ERROR}',

    'file.invalid_chars' => '¡Nombre de archivo inválido! El archivo {FILE} contiene caracteres no permitidos.',
    'file.invalid_maxchars' => '¡Nombre de archivo inválido! El archivo {FILE} contiene demasiados caracteres.',
    'file.invalid_basedir' => '¡Nombre de archivo inválido! El archivo {FILE} no está dentro del directorio base.',
    'file.read' => 'Error al leer el archivo: {FILE}',
    'file.write' => 'Error al escribir el archivo: {FILE}.',
    'file.delete' => 'Error al eliminar el archivo {FILE}',
    'file.copy' => 'Error al copiar el archivo {SOURCE} a {DESTINATION}',
    'file.move' => 'Error al mover el archivo {SOURCE} a {DESTINATION}',

    'dir.create' => 'Error al crear la carpeta: {DIR}',
    'dir.delete' => 'Error al eliminar la carpeta: {DIR}',
    'dir.move' => 'Error al mover la carpeta {SOURCE} a {DESTINATION}',

    'upload.generic' => 'Error al subir el archivo {FILE}',
    'upload.size' => 'Error de subida. ¡El archivo es demasiado grande! Tamaño máximo permitido: {SIZE}',
    'upload.partial' => 'Error de subida. El archivo se subió solo parcialmente.',
    'upload.nofile' => 'Error de subida. No se subió ningún archivo.',
    'upload.tmp' => 'Error de subida. Error al escribir el archivo subido en el directorio temporal.',
    'upload.invalid_type' => 'Error de subida. Tipo de archivo inválido para el archivo: {FILE}. No está permitido subir archivos con esta extensión.',

    'request.not_post' => 'Solicitud inválida. El método de la solicitud debe ser POST.',
    'request.invalid_csrf' => 'Solicitud inválida. El token CSRF es inválido o ha expirado. Por favor, inténtelo de nuevo.'
];
