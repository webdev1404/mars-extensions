<?php

namespace Modules\ContactUs\Plugins\Foo;

use Mars\App;
use Mars\Extensions\Plugin;

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

		//$this->loadLanguage('form');
		//var_dump($this->app->lang);die;
	}

	public function bootMethod()
	{
		//echo "zzzzzz";
	}
}