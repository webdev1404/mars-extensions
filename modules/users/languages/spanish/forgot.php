<?php

return [
    'email' => "Correo electrónico",

    'username.title' => 'Olvidé mi nombre de usuario',
    'username.submit' => "Enviar nombre de usuario",
    'username.success' => "Si el correo electrónico ingresado está asociado a una cuenta, tu nombre de usuario ha sido enviado a esa dirección de correo.",

    'password.title' => 'Olvidé mi contraseña',
    'password.submit' => "Enviar contraseña",
    'password.success' => "Si el correo electrónico ingresado está asociado a una cuenta, se ha enviado un enlace para restablecer la contraseña a esa dirección de correo.",

    'password.reset.title' => 'Restablecer contraseña',
    'password.reset.password' => "Nueva contraseña",
    'password.reset.password_confirm' => "Confirmar contraseña",
    'password.reset.submit' => "Restablecer contraseña",
    'password.reset.success' => "Tu contraseña se ha restablecido correctamente. Ahora puedes <a href=\"{$app->url->route('users.login')}\">iniciar sesión</a> con tu nueva contraseña.",

    'err.email' => "Por favor, ingresa tu correo electrónico",
    'err.email.invalid' => "El correo electrónico ingresado no es válido",

    'err.password' => "Por favor, ingresa tu contraseña",
    'err.password.invalid' => "La contraseña ingresada no es válida. Debe tener entre 6 y 100 caracteres y contener una mezcla de letras, números y caracteres especiales.",
    'err.password.mismatch' => "Las contraseñas ingresadas no coinciden",
    'err.password.params' => "Parámetros de restablecimiento de contraseña no válidos",
    'err.password.reset' => "El enlace para restablecer la contraseña no es válido o ha caducado",
];
