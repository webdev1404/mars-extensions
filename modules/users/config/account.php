<?php

return [
    // Whether to show the captcha on the login form
    'captcha.show' => true,

    // Whether to enable throttling for login attempts
    'throttle.enable' => true,

    // The maximum number of login attempts before throttling
    'throttle.max_attempts' => 20,

    // The duration (in seconds) to block the user after exceeding the maximum number of login attempts
    'throttle.block_duration' => 3600,

    // Whether to allow users to change their username
    'username.readonly' => false,

    // Whether to allow users to change their email address
    'email.readonly' => false,

    // The duration (in hours) for which the email update token is valid
    'email.update.expires_hours' => 24 * 30,

    // Whether to send a notification email when the password is changed
    'password.change.notification' => true,

    // Whether to show the logout button on the account page
    'logout.show' => true,

    // The URL to redirect to after logout. If null, will redirect to the home page
    'logout.url' => null,
];
