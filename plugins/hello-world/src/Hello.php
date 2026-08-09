<?php
/**
* The Hello World Plugin
* @package Mars
*/

namespace Plugins\HelloWorld;

use Mars\Extensions\Plugin;

class Hello extends Plugin
{
    protected array $hooks = [
        'boot' => 'onBoot',
    ];

    public function onBoot()
    {
        $this->app->messages->add('Hello World from the Hello World plugin!');
    }
}
