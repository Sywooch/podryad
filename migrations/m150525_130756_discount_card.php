<?php

use yii\db\Schema;
use yii\db\Migration;

class m150525_130756_discount_card extends Migration
{
    public function up()
    {
        $this->createTable('{{%discount_card}}',[
            'id'=>Schema::TYPE_PK,
            'cvcode'=>'VARCHAR(24) NOT NULL COMMENT "Код"',
            'dateCreate'=>Schema::TYPE_TIMESTAMP,
            'datePrint'=>Schema::TYPE_TIMESTAMP,
            'dateActivate'=>Schema::TYPE_TIMESTAMP,
            'status'=>Schema::TYPE_SMALLINT,
            'userId'=>Schema::TYPE_INTEGER,
            ]);

        $this->createIndex('ixCvCode','{{%discount_card}}','cvcode');
    }

    public function down()
    {
        return $this->dropTable('{{%discount_card}}');
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
