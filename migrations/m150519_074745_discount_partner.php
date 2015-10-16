<?php

use yii\db\Schema;
use yii\db\Migration;

class m150519_074745_discount_partner extends Migration
{
    public function up()
    {
        $this->createTable('{{%discount_partner}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'alias' => Schema::TYPE_STRING,
            'site' => Schema::TYPE_STRING,
            'address' => Schema::TYPE_STRING,
            'workTime' => Schema::TYPE_STRING,
            'phones' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'metaKeywords' => Schema::TYPE_STRING,
            'metaDescription' => Schema::TYPE_STRING,
            'dateCreate' => Schema::TYPE_TIMESTAMP,
            'visible' => Schema::TYPE_SMALLINT,
            'parentId' => Schema::TYPE_INTEGER . ' DEFAULT 0',
        ]);

        $this->createIndex('ixAlias', '{{%discount_partner}}', ['alias']);
        $this->createIndex('ixVisible', '{{%discount_partner}}', ['visible']);
        $this->createIndex('ixParent', '{{%discount_partner}}', ['parentId']);
    }

    public function down()
    {
        $this->dropTable('{{%discount_partner}}');
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
