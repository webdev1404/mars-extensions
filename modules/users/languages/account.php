<?php

return [
    'title' => "Account",
    'logout' => "Logout",
    'hello' => "Hello {$app->user->username},",
    'password_new' => "New Password",
    'password_new_confirm' => "Confirm New Password",
    'password_current' => "Current Password",
    'submit' => "Update",

    'success' => "Your account has been updated successfully",
    'success.email' => "Your account has been updated successfully. Please check your email to confirm the new email address.",
    'success.email.confirmed' => "Your email address has been updated successfully.",

    'err.password.current' => "Please enter your current password.",
    'err.password.current.invalid' => "Your current password is incorrect",

    'err.email.params' => "Invalid email update parameters",
    'err.email.failed' => "Email update failed. The email update token is invalid or has expired. Please try updating your email address again.",
];
