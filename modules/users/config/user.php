<?php

return [
    'user.registration.open' => true,
    'user.registration.show_captcha' => true,
    'user.registration.show_agreement' => true,
    'user.registration.notify.enable' => true,
    'user.registration.notify.emails' => [],
    'user.registration.notify.same_email' => true,
    'user.registration.throttle.enable' => true,
    'user.registration.throttle.max_attempts' => 10,
    'user.registration.throttle.block_duration' => 3600,

    'user.forgot.show_captcha' => true,

    'user.activation.expires_days' => 1,
];