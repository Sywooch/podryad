<?php

use yii\db\Schema;
use yii\db\Migration;

class m150518_122627_city_create extends Migration
{
    public function up()
    {
        $this->createTable('{{%city}}',[
            'code'=>Schema::TYPE_PK,
            'title'=>Schema::TYPE_STRING.' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%city}}');
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
