<?php

namespace nagser\users\controllers;

use nagser\users\Module;
use nagser\base\behaviors\ControllerBehavior;

class SecurityController extends \dektrium\user\controllers\SecurityController {

	public function behaviors()
	{
		return [
			'CustomControllerBehavior' => [
				'class' => ControllerBehavior::className(),
				'module' => Module::className()
			],
		];
	}

}