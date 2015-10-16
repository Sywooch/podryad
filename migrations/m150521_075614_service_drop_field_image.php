<?php

use yii\db\Schema;
use yii\db\Migration;

class m150521_075614_service_drop_field_image extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%discount_service}}','image');
    }

    public function down()
    {
        return $this->addColumn('{{%discount_service}}','image',Schema::TYPE_STRING);
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
