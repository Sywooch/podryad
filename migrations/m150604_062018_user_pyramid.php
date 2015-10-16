<?php

use yii\db\Schema;
use yii\db\Migration;

class m150604_062018_user_pyramid extends Migration
{
    public function up()
    {
        $this->createTable('{{%user_pyramid}}',[
            'id'=>Schema::TYPE_PK,
            'parentId'=>Schema::TYPE_INTEGER,
            'type'=>Schema::TYPE_SMALLINT,
        ]);
        $this->createIndex('ixParentId','{{%user_pyramid}}','parentId');
    }

    public function down()
    {
        return $this->dropTable('{{%user_pyramid}}');
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
