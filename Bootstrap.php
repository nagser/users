<?php

namespace nagser\users;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface {

    public function bootstrap($app){
        //Загрузка языков
        if (!isset($app->get('i18n')->translations['user'])) {
            $app->get('i18n')->translations['user'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/vendor/nagser/users/messages',
                'fileMap' => ['user' => 'user.php']
            ];
        }
    }

}