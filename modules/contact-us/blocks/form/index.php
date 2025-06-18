<?php
if(!defined('MARS')) {
	die;
}

$this->loadLanguage();

$controller = $this->getController();
$controller->dispatch();