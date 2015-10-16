<?php

use yii\db\Schema;
use yii\db\Migration;

class m150521_100916_discount_service_addField_alias extends Migration
{
    public function up()
    {
        $this->addColumn('{{%discount_service}}','alias',Schema::TYPE_STRING);
    }

    public function down()
    {
        return $this->dropColumn('{{%discount_service}}','alias');
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
