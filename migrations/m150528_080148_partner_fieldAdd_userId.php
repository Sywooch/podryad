<?php

use yii\db\Schema;
use yii\db\Migration;

class m150528_080148_partner_fieldAdd_userId extends Migration
{
    public function up()
    {
        $this->addColumn('{{%discount_partner}}','userId',Schema::TYPE_INTEGER.' NOT NULL');
    }

    public function down()
    {
       return $this->dropColumn('{{discount_partner}}','userId');
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
