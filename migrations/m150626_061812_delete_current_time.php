<?php

use yii\db\Schema;
use yii\db\Migration;

class m150626_061812_delete_current_time extends Migration
{
    public function up()
    {
       $this->alterColumn('{{%category}}', 'dateCreate', Schema::TYPE_DATETIME.' DEFAULT "0000-00-00 00:00:00"');
       $this->alterColumn('{{%discount_card}}', 'dateCreate', Schema::TYPE_DATETIME.' DEFAULT "0000-00-00 00:00:00"');
       $this->alterColumn('{{%discount_card}}', 'datePrint', Schema::TYPE_DATETIME.' DEFAULT "0000-00-00 00:00:00"');
       $this->alterColumn('{{%discount_card}}', 'dateActivate', Schema::TYPE_DATETIME.' DEFAULT "0000-00-00 00:00:00"');
       $this->alterColumn('{{%discount_category}', 'dateCreate', Schema::TYPE_DATETIME.' DEFAULT "0000-00-00 00:00:00"');
       $this->alterColumn('{{%discount_history}', 'dateUse', Schema::TYPE_DATETIME.' DEFAULT "0000-00-00 00:00:00"');
       $this->alterColumn('{{%discount_partner}', 'dateCreate', Schema::TYPE_DATETIME.' DEFAULT "0000-00-00 00:00:00"');
       $this->alterColumn('{{%discount_request}', 'dateCreate', Schema::TYPE_DATETIME.' DEFAULT "0000-00-00 00:00:00"');
       $this->alterColumn('{{%discount_request}', 'dateActivate', Schema::TYPE_DATETIME.' DEFAULT "0000-00-00 00:00:00"');
    }

    public function down()
    {
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
