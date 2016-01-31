<?php

use yii\db\Schema;
use yii\db\Migration;

class m151225_140117_users extends Migration
{
    public function up()
    {
        $tableOptions = 'ENGINE=InnoDB';
        if (!Yii::$app->db->schema->getTableSchema('user')) {
            $this->createTable('{{%user}}',
                [
                    'id' => Schema::TYPE_PK . '',
                    'username' => Schema::TYPE_STRING . '(255) NOT NULL',
                    'email' => Schema::TYPE_STRING . '(255) NOT NULL',
                    'password_hash' => Schema::TYPE_STRING . '(60) NOT NULL',
                    'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
                    'confirmed_at' => Schema::TYPE_INTEGER . '(11)',
                    'unconfirmed_email' => Schema::TYPE_STRING . '(255)',
                    'blocked_at' => Schema::TYPE_INTEGER . '(11)',
                    'registration_ip' => Schema::TYPE_STRING . '(45)',
                    'created_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
                    'updated_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
                    'flags' => Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT "0"',
                ], $tableOptions);

            $this->createIndex('user_unique_email', '{{%user}}', 'email', 1);
            $this->createIndex('user_unique_username', '{{%user}}', 'username', 1);
        }
        if (!Yii::$app->db->schema->getTableSchema('profile')) {
            $this->createTable('{{%profile}}',
                [
                    'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
                    'name' => Schema::TYPE_STRING . '(255)',
                    'public_email' => Schema::TYPE_STRING . '(255)',
                    'gravatar_email' => Schema::TYPE_STRING . '(255)',
                    'gravatar_id' => Schema::TYPE_STRING . '(32)',
                    'location' => Schema::TYPE_STRING . '(255)',
                    'website' => Schema::TYPE_STRING . '(255)',
                    'bio' => Schema::TYPE_TEXT . '',
                ], $tableOptions);

            $this->addForeignKey('fk_profile_user_id', '{{%profile}}', 'user_id', 'user', 'id');
        }
        if (!Yii::$app->db->schema->getTableSchema('profile')) {
            $this->createTable('{{%social_account}}',
                [
                    'id' => Schema::TYPE_PK . '',
                    'user_id' => Schema::TYPE_INTEGER . '(11)',
                    'provider' => Schema::TYPE_STRING . '(255) NOT NULL',
                    'client_id' => Schema::TYPE_STRING . '(255) NOT NULL',
                    'data' => Schema::TYPE_TEXT . '',
                    'code' => Schema::TYPE_STRING . '(32)',
                    'created_at' => Schema::TYPE_INTEGER . '(11)',
                    'email' => Schema::TYPE_STRING . '(255)',
                    'username' => Schema::TYPE_STRING . '(255)',
                ], $tableOptions);

            $this->createIndex('account_unique', '{{%social_account}}', 'provider,client_id', 1);
            $this->createIndex('account_unique_code', '{{%social_account}}', 'code', 1);
            $this->createIndex('fk_user_account', '{{%social_account}}', 'user_id', 0);
            $this->addForeignKey('fk_social_account_user_id', '{{%social_account}}', 'user_id', 'user', 'id');

        }
        if (!Yii::$app->db->schema->getTableSchema('profile')) {
            $this->createTable('{{%token}}',
                [
                    'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
                    'code' => Schema::TYPE_STRING . '(32) NOT NULL',
                    'created_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
                    'type' => Schema::TYPE_SMALLINT . '(6) NOT NULL',
                ], $tableOptions);

            $this->createIndex('token_unique', '{{%token}}', 'user_id,code,type', 1);
            $this->addForeignKey('fk_token_user_id', '{{%token}}', 'user_id', 'user', 'id');
        }
    }

    public function down()
    {
        $this->dropForeignKey('fk_profile_user_id', '{{%profile}}');
        $this->dropForeignKey('fk_social_account_user_id', '{{%social_account}}');
        $this->dropForeignKey('fk_token_user_id', '{{%token}}');
        $this->dropTable('{{%profile}}');
        $this->dropTable('{{%social_account}}');
        $this->dropTable('{{%token}}');
        $this->dropTable('{{%user}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
