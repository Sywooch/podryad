<?php

use yii\db\Schema;
use yii\db\Migration;

class m150527_131458_user_profile_add_photo extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user_profile}}','photo',Schema::TYPE_STRING.' NOT NULL');
    }

    public function down()
    {
        return $this->dropColumn('{{%user_profile}}','photo');
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
