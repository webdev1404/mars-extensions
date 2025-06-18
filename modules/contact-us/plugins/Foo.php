<?php

namespace Modules\ContactUs\Plugins;

use Mars\Extensions\Plugin;
use Mars\App;

class Foo extends Plugin
{
    protected array $hooks = ['boot' => 'bootMethod'];

	/**
	 * Builds the plugin
	 * @param App $app The app object
	 */
	public function __construct(App $app = null)
	{
		parent::__construct($app);

		$this->module->loadLanguage('form');
	}

	public function bootMethod()
	{
		$this->module->render('test');
	}
}