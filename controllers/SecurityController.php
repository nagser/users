<?php

namespace app\modules\users\controllers;

use app\modules\users\Module;
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