<?php

return [
    'title' => "Registration",
    'username' => "Username",
    'email' => "Email",
    'password' => "Password",
    'password_confirm' => "Confirm Password",
    'submit' => "Register",

    'success' => "You have successfully registered. Please check your email for instructions to activate your account.",

    'agreement.title' => "Registration Agreement",
    'agreement.link' => "I have read and agree to the registration terms and conditions.",

    'registration_closed.title' => "Registration Closed",

    'resend_activation.link' => "Resend Activation Code",
    'resend_activation.title' => "Resend Activation Code",
    'resend_activation.submit' => "Resend Activation Code",
    'resend_activation.success' => "If an account with the provided email exists and is not activated, a new activation email has been sent. Please check your inbox.",

    'activation.success' => "Your account has been successfully activated. You can now <a href=\"{$app->url->route('users.login')}\">log in</a>.",
    'activation.failed' => "Account activation failed. Invalid activation key or the key has expired. Please request a new activation email from the <a href=\"{$app->url->route('users.register.resend_activation')}\">resend activation page</a>.",

    'err.username' => "Please enter the username",
    'err.username.invalid' => "The username is not valid. It should be between 5 and 100 characters long and can only contain letters, numbers, underscores, and dots.",
    'err.username.exists' => "The username is already taken. Please choose a different one.",
    'err.email' => "Please enter the email",
    'err.email.invalid' => "The email is not valid",
    'err.email.exists' => "The email is already registered. Please use a different email.",
    'err.password' => "Please enter the password",
    'err.password.invalid' => "The password is not valid. It should be between 6 and 100 characters long and include a mix of letters, numbers, and special characters.",
    'err.password.mismatch' => "The passwords do not match",
    'err.agreement' => "You must agree to the registration terms and conditions to proceed",

    'err.activation.params' => "Invalid activation parameters",
];
