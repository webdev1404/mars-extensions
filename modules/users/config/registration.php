<?php

return [
    // Whether the registration is open or closed
    'open' => true,

    // Whether to show the captcha on the registration form
    'captcha.show' => true,

    // Whether to show the agreement checkbox on the registration form
    'agreement.show' => true,

    // Whether to enable admin notification for new registrations
    'notify.enable' => true,

    // The emails to notify for new registrations. If empty, will use the site emails
    'notify.emails' => [],

    // Whether to send an email to the user, if the email is already registered
    'notify.same_email' => true,

    // Whether to enable throttling for registration attempts
    'throttle.enable' => true,

    // The maximum number of registration attempts before throttling
    'throttle.max_attempts' => 10,

    // The duration (in seconds) to block the user after exceeding the maximum number of registration attempts
    'throttle.block_duration' => 3600,
];
