<?php

use Mars\App;

use Modules\Users\System\User;

$app->set('user', function () {
    return new User;
});
