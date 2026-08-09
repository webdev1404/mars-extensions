<?php
use Mars\App;

$menu->add([
    'users.login' => [App::__('users:menu.login'), 'users.login'],
    'users.register' => [App::__('users:menu.register'), 'users.register']
], priority: 500);
