<?php

return [
    'title' => "Registro",
    'username' => "Nombre de usuario",
    'email' => "Correo electrónico",
    'password' => "Contraseña",
    'password_confirm' => "Confirmar contraseña",
    'submit' => "Registrarse",

    'success' => "Te has registrado correctamente. Revisa tu correo electrónico para ver las instrucciones para activar tu cuenta.",

    'agreement.title' => "Acuerdo de registro",
    'agreement.link' => "He leído y acepto los términos y condiciones de registro.",

    'registration_closed.title' => "Registro cerrado",

    'resend_activation.link' => "Reenviar código de activación",
    'resend_activation.title' => "Reenviar código de activación",
    'resend_activation.submit' => "Reenviar código de activación",
    'resend_activation.success' => "Si existe una cuenta con el correo proporcionado y no está activada, se ha enviado un nuevo correo de activación. Revisa tu bandeja de entrada.",

    'activation.success' => "Tu cuenta se ha activado correctamente. Ahora puedes <a href=\"{$app->url->route('users.login')}\">iniciar sesión</a>.",
    'activation.failed' => "La activación de la cuenta falló. La clave de activación es inválida o ha caducado. Solicita un nuevo correo de activación desde la <a href=\"{$app->url->route('users.register.resend_activation')}\">página de reenvío de activación</a>.",

    'err.username' => "Por favor, introduce el nombre de usuario",
    'err.username.invalid' => "El nombre de usuario no es válido. Debe tener entre 5 y 100 caracteres y solo puede contener letras, números, guiones bajos y puntos.",
    'err.username.exists' => "El nombre de usuario ya está en uso. Elige uno diferente.",
    'err.email' => "Por favor, introduce el correo electrónico",
    'err.email.invalid' => "El correo electrónico no es válido",
    'err.email.exists' => "El correo electrónico ya está registrado. Usa uno diferente.",
    'err.password' => "Por favor, introduce la contraseña",
    'err.password.invalid' => "La contraseña no es válida. Debe tener entre 6 y 100 caracteres e incluir una combinación de letras, números y caracteres especiales.",
    'err.password.mismatch' => "Las contraseñas no coinciden",
    'err.agreement' => "Debes aceptar los términos y condiciones de registro para continuar",

    'err.activation.params' => "Parámetros de activación inválidos",
];
