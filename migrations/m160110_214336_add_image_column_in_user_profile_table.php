<?php

use yii\db\Schema;
use yii\db\Migration;

class m160110_214336_add_image_column_in_user_profile_table extends Migration
{
    public function up()
    {
        if (Yii::$app->db->schema->getTableSchema('profile')) {
            $this->addColumn('profile', 'image', 'string');
        } else {
            new \yii\base\ErrorException('Table "profile" not found!');
        }
    }

    public function down()
    {
        if (Yii::$app->db->schema->getTableSchema('profile')) {
            $this->dropColumn('profile', 'image');
        } else {
            new \yii\base\ErrorException('Table "profile" not found!');
        }
    }
}
