<?php

use yii\db\Schema;
use yii\db\Migration;

class m150519_103355_discount_service_create extends Migration
{
    public function up()
    {
        $this->createTable('{{%discount_service}}',[
           'id'=>Schema::TYPE_PK,
           'title'=>Schema::TYPE_STRING.' NOT NULL',
           'description'=>Schema::TYPE_TEXT,
           'discount'=>Schema::TYPE_DECIMAL.' NOT NULL',
           'parentId'=>Schema::TYPE_INTEGER.' DEFAULT 0',
           'categoryId'=>Schema::TYPE_INTEGER.' DEFAULT 0',
           'image'=>Schema::TYPE_STRING.'',
        ]);
        $this->createIndex('ixParentId','{{%discount_service}}','parentId');
        $this->createIndex('ixCategoryId','{{%discount_service}}','categoryId');
    }

    public function down()
    {
        return $this->dropTable('{{%discount_service}}');
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
