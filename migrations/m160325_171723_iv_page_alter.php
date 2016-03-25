<?php

use yii\db\Schema;
use yii\db\Migration;

class m160325_171723_iv_page_alter extends Migration
{
    public function up()
    {
        $this->addColumn('{{%page}}','metaTitle',Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('{{%page}}','metaTitle');
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
