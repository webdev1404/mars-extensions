<?php

return [
    'email' => "Email",

    'username.title' => 'Forgot Username',
    'username.submit' => "Send Username",
    'username.success' => "If the email you entered is associated with an account, your username has been sent to that email address.",

    'password.title' => 'Forgot Password',
    'password.submit' => "Send Password",
    'password.success' => "If the email you entered is associated with an account, a password reset link has been sent to that email address.",

    'password.reset.title' => 'Reset Password',
    'password.reset.password' => "New Password",
    'password.reset.password_confirm' => "Confirm Password",
    'password.reset.submit' => "Reset Password",
    'password.reset.success' => "Your password has been successfully reset. You can now <a href=\"{$app->url->route('users.login')}\">log in</a> with your new password.",

    'err.email' => "Please enter your email",
    'err.email.invalid' => "The email you entered is not valid",

    'err.password' => "Please enter your password",
    'err.password.invalid' => "The password you entered is not valid. It should be between 6 and 100 characters long and include a mix of letters, numbers, and special characters.",
    'err.password.mismatch' => "The passwords you entered do not match",
    'err.password.params' => "Invalid password reset parameters",
    'err.password.reset' => "The password reset link is invalid or has expired",
];
