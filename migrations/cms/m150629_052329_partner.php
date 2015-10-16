<?php

use yii\db\Schema;
use yii\db\Migration;

class m150629_052329_partner extends Migration
{
    public function up()
    {
        $this->createTable('{{%user_partner}}', [
           'userId'=>  Schema::TYPE_INTEGER.' NOT NULL COMMENT "Пользователь"', 
           'partnerId'=>  Schema::TYPE_INTEGER.' NOT NULL COMMENT "Партнер"', 
        ]);
        $this->createIndex('unique', '{{%user_partner}}', ['userId','partnerId']);
    }

    public function down()
    {
        $this->dropTable('{{%user_partner}}');
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
