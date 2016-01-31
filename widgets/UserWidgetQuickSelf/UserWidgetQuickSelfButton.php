<?php

namespace app\modules\users\widgets\UserWidgetQuickSelf;

use app\base\widgets\concat\Concat;
use kartik\helpers\Html;

class UserWidgetQuickSelfButton extends Concat {

    public function run(){
        return Html::a($this->getContent(), '#', $this->containerOptions);
    }

}