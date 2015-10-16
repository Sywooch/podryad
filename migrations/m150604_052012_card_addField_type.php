<?php

use yii\db\Schema;
use yii\db\Migration;

class m150604_052012_card_addField_type extends Migration
{
    public function up()
    {
        $this->addColumn('{{%discount_card}}','type',Schema::TYPE_SMALLINT);
        $this->createIndex('ixType','{{%discount_card}}','type');
    }

    public function down()
    {
        return $this->dropColumn('{{%discount_card}}','type');
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
