<?php

return [
    'title' => "Registration",
    'register' => "Register",
    'username' => "Username",
    'email' => "Email",
    'password' => "Password",
    'password_confirm' => "Confirm Password",
    'agreement' => "I have read and agree to the registration terms and conditions.",

    'success' => "You have successfully registered. Please check your email for instructions to activate your account.",

    'agreement_title' => "Registration Agreement",
    'registration_closed_title' => "Registration Closed",

    'resend_activation_link' => "Resend Activation Code",
    'resend_activation_title' => "Resend Activation Code",
    'resend_activation_button' => "Resend Activation Code",
    'resend_activation_success' => "If an account with the provided email exists and is not activated, a new activation email has been sent. Please check your inbox.",

    'activation_success' => "Your account has been successfully activated. You can now log in.",
    'activation_failed' => "Account activation failed. Invalid activation key or the key has expired. Please request a new activation email from the <a href=\"{$app->url->route('users.register.resend_activation')}\">resend activation page</a>.",

    'err.username' => "Please enter your username",
    'err.username.invalid' => "The username you entered is not valid. It should be between 5 and 100 characters long and can only contain letters, numbers, underscores, and dots.",
    'err.username.exists' => "The username you entered is already taken. Please choose a different one.",
    'err.email' => "Please enter your email",
    'err.email.invalid' => "The email you entered is not valid",
    'err.email.exists' => "The email you entered is already registered. Please use a different email.",
    'err.password' => "Please enter your password",
    'err.password.invalid' => "The password you entered is not valid. It should be between 6 and 100 characters long and include a mix of letters, numbers, and special characters.",
    'err.password.mismatch' => "The passwords you entered do not match",
    'err.agreement' => "You must agree to the registration terms and conditions to proceed",
    
    
    'err.activation.params' => "Invalid activation parameters",
];
