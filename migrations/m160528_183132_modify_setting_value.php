<?php

use yii\db\Migration;

class m160528_183132_modify_setting_value extends Migration
{
    public function up()
    {
        return $this->alterColumn('{{%settings}}','value',$this->text());
    }

    public function down()
    {
        return $this->alterColumn('{{%settings}}', 'value', $this->string(300));
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
