<?php

namespace app\modules\users\widgets\UserWidgetAvatar;

use kartik\widgets\Widget;
use yii\helpers\Html;

class UserWidgetAvatar extends Widget
{

    public function run()
    {
        return Html::img('http://admindesigns.com/demos/absolute/1.1/assets/img/avatars/5.jpg', ['class' => 'mw30 br64']);
    }

}
