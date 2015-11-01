<?php

use yii\db\Schema;
use yii\db\Migration;

class m151101_073236_articleMetaTags extends Migration
{
    public function up()
    {
        $this->addColumn('{{%article}}','metaKeywords',Schema::TYPE_STRING);
        $this->addColumn('{{%article}}','metaDescription',Schema::TYPE_STRING);
        return true;
    }

    public function down()
    {
        $this->dropColumn('{{%article}}','metaKeywords');
        $this->dropColumn('{{%article}}','metaDescription');
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
