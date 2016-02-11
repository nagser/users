<?php

namespace nagser\users\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

class AuthorBehavior extends AttributeBehavior {

    public $authorAttribute = 'author_id';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->authorAttribute],
            ];
        }
    }

    protected function getValue($event){
        if ($this->value instanceof Expression) {
            return $this->value;
        } else {
            return $this->value !== null ? call_user_func($this->value, $event) : \Yii::$app->user->identity->id;
        }
    }

}