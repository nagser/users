<?php

namespace app\modules\users\models;

use yii\helpers\ArrayHelper;

class User extends \dektrium\user\models\User
{

//    /**
//     * Массив пользователей в виде id => ФИО
//     * */
//    public function asList(){
//        $users = self::find()->with('profile')->asArray()->all();
//        return ArrayHelper::map($users, 'id', 'profile.name');
//    }

}
