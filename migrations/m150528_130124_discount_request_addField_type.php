<?php

use yii\db\Schema;
use yii\db\Migration;

class m150528_130124_discount_request_addField_type extends Migration
{
    public function up()
    {
        $this->addColumn('{{%discount_request}}','type',Schema::TYPE_STRING);
    }

    public function down()
    {
        return $this->dropColumn('{{%discount_request}}','type');
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
