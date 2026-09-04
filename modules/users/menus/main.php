<?php
use Mars\App;

if ($this->app->user->is_logged) {
    $menu->can_cache = false;
    
    $menu->add([
        'users.account' => [App::__('users:menu.account'), 'users.account'],
        'users.logout' => [App::__('users:menu.logout'), 'javascript:moduleUsers.logout(\'' . $this->app->escape->js($this->app->url->get('users.logout')) . '\')']
    ], priority: 500);
} else {
    $menu->add([
        'users.login' => [App::__('users:menu.login'), 'users.login'],
        'users.register' => [App::__('users:menu.register'), 'users.register']
    ], priority: 500);
}
