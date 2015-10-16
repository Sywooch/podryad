<?php

use yii\db\Schema;
use yii\db\Migration;

class m150522_114055_discount_request extends Migration
{
    public function up()
    {
        $this->createTable('{{%discount_request}}',[
            'id'=>Schema::TYPE_PK,
            'username'=>Schema::TYPE_STRING.' NOT NULL COMMENT "ФИО"',
            'cityId'=>Schema::TYPE_INTEGER.' NOT NULL COMMENT "Город"',
            'phone'=>Schema::TYPE_STRING.' NOT NULL COMMENT "Телефон"',
            'email'=>Schema::TYPE_STRING.' NOT NULL COMMENT "Email"',
            'dateCreate'=>Schema::TYPE_TIMESTAMP.' COMMENT "Дата регистрации"',
            'dateActivate'=>Schema::TYPE_TIMESTAMP.'  COMMENT "Дата активации"',
            'status'=>Schema::TYPE_SMALLINT.' DEFAULT 0',
            'userId'=>Schema::TYPE_INTEGER.' DEFAULT 0',
        ]);
        $this->createIndex('ixCityId','{{%discount_request}}','cityId');
        $this->createIndex('ixUserId','{{%discount_request}}','userId');
    }

    public function down()
    {
        return $this->dropTable('{{%discount_request}}');
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
