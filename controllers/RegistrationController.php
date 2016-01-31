<?php

namespace app\modules\users\controllers;

use app\base\behaviors\CustomControllerBehavior;
use app\modules\users\Module;

class RegistrationController extends \dektrium\user\controllers\RegistrationController {

    public function behaviors()
    {
        return [
            'CustomControllerBehavior' => [
                'class' => CustomControllerBehavior::className(),
                'module' => Module::className()
            ],
        ];
    }

}