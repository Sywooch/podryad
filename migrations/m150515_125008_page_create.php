<?php

use yii\db\Schema;
use yii\db\Migration;

class m150515_125008_page_create extends Migration
{
    public function up()
    {
        $this->createTable('{{%page}}', [
            'id'                => Schema::TYPE_PK,
            'title'             => Schema::TYPE_STRING . ' NOT NULL',
            'alias'             => Schema::TYPE_STRING,
            'description'       => Schema::TYPE_TEXT,
            'metaKeywords'      => Schema::TYPE_STRING,
            'metaDescription'   => Schema::TYPE_STRING,
            'dateCreate'        => Schema::TYPE_TIMESTAMP,
            'visible'           => Schema::TYPE_SMALLINT,
            'parentId'          => Schema::TYPE_INTEGER. ' DEFAULT 0',
        ]);

        $this->createIndex('ixAlias','{{%page}}',['alias']);
        $this->createIndex('ixVisible','{{%page}}',['visible']);
        $this->createIndex('ixParent','{{%page}}',['parentId']);
    }

    public function down()
    {
        $this->dropTable('{{%page}}');
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
