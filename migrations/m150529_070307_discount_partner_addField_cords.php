<?php

use yii\db\Schema;
use yii\db\Migration;

class m150529_070307_discount_partner_addField_cords extends Migration
{
    public function up()
    {
        $this->addColumn('{{%discount_partner}}','cords',Schema::TYPE_STRING);
    }

    public function down()
    {
        return $this->dropColumn('{{%discount_partner}}','cords');
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
