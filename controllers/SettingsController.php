<?php

namespace app\modules\users\controllers;

use app\base\behaviors\CustomControllerBehavior;
use app\modules\users\models\Profile;
use app\modules\users\Module;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;

class SettingsController extends \dektrium\user\controllers\SettingsController {

    public function behaviors()
    {
        return [
            'CustomControllerBehavior' => [
                'class' => CustomControllerBehavior::className(),
                'module' => Module::className()
            ],
        ];
    }

    /**
     * @inheritdoc
     */
//    public function actions()
//    {
//        return ArrayHelper::merge(parent::actions(), [
//            'deleteImage' => [
//                'class' => 'demi\image\DeleteImageAction',
//                'modelClass' => Profile::className(),
//                'canDelete' => function ($model) {
//                    /* @var $model Profile */
//                    return $model->user_id == Yii::$app->user->id;
//                },
//                'redirectUrl' => function ($model) {
//                    /* @var $model Profile */
//                    // triggered on !Yii::$app->request->isAjax, else will be returned JSON: {status: "success"}
//                    return ['/user/settings/profile', 'user_id' => $model->user_id];
//                },
//                'afterDelete' => function ($model) {
//                    /* @var $model Profile */
//                    // You can customize response by this function, e.g. change response:
//                    if (Yii::$app->request->isAjax) {
//                        Yii::$app->response->getHeaders()->set('Vary', 'Accept');
//                        return Json::encode(['type' => 'success', 'message' => Yii::t('gallery', 'Image deleted')]);
//                    } else {
//                        return Yii::$app->response->redirect(['/user/settings/profile', 'user_id' => $model->user_id]);
//                    }
//                },
//            ],
//            'cropImage' => [
//                'class' => 'demi\image\CropImageAction',
//                'modelClass' => Profile::className(),
//                'redirectUrl' => function ($model) {
//                    /* @var $model Profile*/
//                    // triggered on !Yii::$app->request->isAjax, else will be returned JSON: {status: "success"}
//                    return ['update', 'user_id' => $model->user_id];
//                },
//            ],
//        ]);
//    }

}