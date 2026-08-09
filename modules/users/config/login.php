<?php

return [
    // Whether to show the captcha on the login form
    'captcha.show' => true,

    // Whether to show the "remember me" checkbox on the login form
    'remember_me.show' => true,

    // Whether the "remember me" checkbox is checked by default
    'remember_me.checked' => true,

    // The default value for the "remember me" if remember_me.show is false
    'remember_me.default' => true,

    // The duration (in seconds) to remember the user if "remember me" is checked
    'remember_me.duration' => 3600 * 24 * 30,

    // Whether to enable throttling for login attempts
    'throttle.enable' => true,

    // The maximum number of login attempts before throttling
    'throttle.max_attempts' => 10,

    // The duration (in seconds) to block the user after exceeding the maximum number of login attempts
    'throttle.block_duration' => 3600,

    // The URL to redirect to after login. If null, will redirect to the home page
    'redirect.url' => null,
];
