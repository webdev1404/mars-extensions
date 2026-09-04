<?php

return [
    // Whether to show the captcha on the forgot username/password forms
    'captcha.show' => true,

    // Whether to enable throttling for forgotten username/password attempts
    'throttle.enable' => true,

    // The maximum number of attempts before throttling
    'throttle.max_attempts' => 10,

    // The duration (in seconds) to block the user after exceeding the maximum number of attempts
    'throttle.block_duration' => 3600,

    // The number of hours after which the password reset link will expire
    'password.expires_hours' => 24,

    // The grace period (in seconds) after the password reset link has expired, during which the user can still reset their password
    'password.expires.grace_period' => 3600,
];
