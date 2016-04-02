<?php

use yii\db\Schema;
use yii\db\Migration;

class m160402_154637_tenderMeta extends Migration
{
    public function up()
    {
        $this->addColumn('{{%tender}}','metaTitle',Schema::TYPE_STRING);
        $this->addColumn('{{%tender}}','metaKeywords',Schema::TYPE_STRING);
        $this->addColumn('{{%tender}}','metaDescription',Schema::TYPE_TEXT);
    }

    public function down()
    {
        $this->dropColumn('{{%tender}}','metaTitle');
        $this->dropColumn('{{%tender}}','metaKeywords');
        $this->dropColumn('{{%tender}}','metaDescription');
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
