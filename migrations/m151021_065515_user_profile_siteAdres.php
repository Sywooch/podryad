<?php

use yii\db\Schema;
use yii\db\Migration;

class m151021_065515_user_profile_siteAdres extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user_profile}}','site',Schema::TYPE_STRING);
        $this->addColumn('{{%user_profile}}','adres',Schema::TYPE_STRING);
        return true;
    }

    public function down()
    {
        $this->dropColumn('{{%user_profile}}','site');
        $this->dropColumn('{{%user_profile}}','adres');
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
