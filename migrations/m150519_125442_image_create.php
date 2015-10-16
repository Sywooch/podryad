<?php

use yii\db\Schema;
use yii\db\Migration;

class m150519_125442_image_create extends Migration
{
    public function up()
    {
        $this->createTable('{{%image}}',[
            'id'=>Schema::TYPE_PK,
            'src'=>Schema::TYPE_STRING.' NOT NULL COMMENT "Изображение"',
            'model'=>Schema::TYPE_STRING.' NOT NULL COMMENT "Модель"',
            'primaryKey'=>Schema::TYPE_INTEGER.' UNSIGNED NOT NULL COMMENT "Ключ"',
        ]);

        $this->createIndex('ixPrimaryKey','{{%image}}',['primaryKey','model']);
    }

    public function down()
    {
        return $this->dropTable('{{%image}}');
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
