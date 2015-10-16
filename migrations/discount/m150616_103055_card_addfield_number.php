<?php

use yii\db\Schema;
use yii\db\Migration;

class m150616_103055_card_addfield_number extends Migration
{
    public function up()
    {
        $this->addColumn('{{%discount_card}}', 'number', Schema::TYPE_STRING.' COMMENT "Номер карты"');
    }

    public function down()
    {
       return $this->dropColumn('{{%discount_card}}', 'number');
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
