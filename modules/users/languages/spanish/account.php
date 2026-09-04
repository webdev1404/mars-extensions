<?php

return [
    'title' => "Cuenta",
    'logout' => "Cerrar sesión",
    'hello' => "Hola {$app->user->username},",
    'password_new' => "Nueva contraseña",
    'password_new_confirm' => "Confirmar nueva contraseña",
    'password_current' => "Contraseña actual",
    'submit' => "Actualizar",

    'success' => "Tu cuenta se ha actualizado correctamente",
    'success.email' => "Tu cuenta se ha actualizado correctamente. Por favor, revisa tu correo electrónico para confirmar la nueva dirección de correo.",
    'success.email.confirmed' => "Tu dirección de correo electrónico se ha actualizado correctamente.",

    'err.password.current' => "Por favor, introduce tu contraseña actual.",
    'err.password.current.invalid' => "Tu contraseña actual es incorrecta",

    'err.email.params' => "Parámetros de actualización de correo inválidos",
    'err.email.failed' => "La actualización del correo electrónico falló. El token de actualización del correo es inválido o ha expirado. Por favor, intenta actualizar tu dirección de correo electrónico de nuevo.",
];
