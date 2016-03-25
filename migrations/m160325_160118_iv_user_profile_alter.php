<?php

use yii\db\Schema;
use yii\db\Migration;

class m160325_160118_iv_user_profile_alter extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user_profile}}','metaTitle',Schema::TYPE_STRING);
        $this->addColumn('{{%user_profile}}','metaDescription',Schema::TYPE_STRING);
        $this->addColumn('{{%user_profile}}','metaKeywords',Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('{{%user_profile}}','metaKeywords');
        $this->dropColumn('{{%user_profile}}','metaDescription');
        $this->dropColumn('{{%user_profile}}','metaTitle');
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
