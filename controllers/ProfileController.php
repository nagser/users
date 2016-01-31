<?php

namespace app\modules\users\controllers;

use app\base\behaviors\CustomControllerBehavior;
use app\modules\users\models\Profile;
use app\modules\users\Module;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class ProfileController extends \dektrium\user\controllers\ProfileController {

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