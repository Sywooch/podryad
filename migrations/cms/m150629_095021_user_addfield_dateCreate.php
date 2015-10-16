<?php

use yii\db\Schema;
use yii\db\Migration;

class m150629_095021_user_addfield_dateCreate extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'dateCreate', Schema::TYPE_DATETIME.' COMMENT "Дата регистрации"');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}','dateCreate');
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
