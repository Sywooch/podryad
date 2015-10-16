<?php

use yii\db\Schema;
use yii\db\Migration;

class m150526_141201_userProfile_create extends Migration
{
    public function up()
    {
        $this->createTable('{{%user_profile}}',[
            'userId'=>Schema::TYPE_PK,
            'phone'=>Schema::TYPE_STRING,
            'name'=>Schema::TYPE_STRING,
            'cityId'=>Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        return $this->dropTable('{{user_profile}}');
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
