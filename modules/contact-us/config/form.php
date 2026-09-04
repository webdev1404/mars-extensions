<?php

return [
    // The email addresses to which contact form submissions should be sent. If empty, the site emails will be used.
    'emails' => [],

    // Whether to show the captcha on the contact form
    'captcha.show' => true,

    // Whether to enable throttling for contact form submissions
    'throttle.enable' => true,

    // The maximum number of contact form submission attempts before throttling
    'throttle.max_attempts' => 10,

    // The duration (in seconds) to block the user after exceeding the maximum number of contact form submission attempts
    'throttle.block_duration' => 3600,
];
