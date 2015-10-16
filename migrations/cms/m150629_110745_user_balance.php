<?php

use yii\db\Schema;
use yii\db\Migration;

class m150629_110745_user_balance extends Migration
{
    public function up()
    {
        $this->createTable('{{%user_balance_history}}', [
           'id'=>  Schema::TYPE_STRING.' PRIMARY KEY', 
           'userId'=>  Schema::TYPE_INTEGER.' NOT NULL COMMENT "Пользователь"', 
           'type'=>  Schema::TYPE_SMALLINT.' NOT NULL COMMENT "Тип операции"', 
           'sum'=>  Schema::TYPE_DECIMAL.'(20,2) NOT NULL COMMENT "Сумма"', 
           'date'=>  Schema::TYPE_DATETIME.' NOT NULL COMMENT "Дата и время"', 
        ]);
        $this->addColumn('{{%user_profile}}', 'balance', Schema::TYPE_DECIMAL.'(20,2) DEFAULT "0.00" COMMENT "Баланс"');
    }

    public function down()
    {
        $this->dropTable('{{%user_balance_history}}');
        $this->dropColumn('{{%user_profile}}', 'balance');
        return true;
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
