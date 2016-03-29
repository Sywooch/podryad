<?php

use yii\db\Schema;
use yii\db\Migration;

class m160329_183724_settings_edit extends Migration
{
    public function up()
    {
        $this->addColumn('{{%settings}}','isSystem',Schema::TYPE_INTEGER.' DEFAULT 0');
    }

    public function down()
    {
        return $this->dropColumn('{{%settings}}','isSystem');
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
