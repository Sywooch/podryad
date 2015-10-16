<?php

use yii\db\Schema;
use yii\db\Migration;

class m150603_103510_pyramid_create extends Migration
{
    public function up()
    {
        $this->createTable('{{%pyramid}}',[
            'id'=>Schema::TYPE_PK,
            'title'=>Schema::TYPE_STRING,
            'parentId'=>Schema::TYPE_INTEGER,
        ]);
        $this->createIndex('ixParentId','{{%pyramid}}','parentId');
    }

    public function down()
    {
        return $this->dropTable('{{%pyramid}}');
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
