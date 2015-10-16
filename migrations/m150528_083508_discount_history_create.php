<?php

use yii\db\Schema;
use yii\db\Migration;

class m150528_083508_discount_history_create extends Migration
{
    public function up()
    {
        $this->createTable('{{%discount_history}}',[
           'id'=>Schema::TYPE_PK,
           'serviceId'=>Schema::TYPE_INTEGER.' NOT NULL COMMENT "Услуга"',
           'userId'=>Schema::TYPE_INTEGER.' NOT NULL  COMMENT "Пользователь"',
           'dateUse'=>Schema::TYPE_TIMESTAMP.' COMMENT "Дата использования"',
        ]);
    }

    public function down()
    {
        return $this->dropTable('{{%discount_history}}');
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
