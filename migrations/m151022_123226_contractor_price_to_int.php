<?php

use yii\db\Schema;
use yii\db\Migration;

class m151022_123226_contractor_price_to_int extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%contractor_price}}', 'price', Schema::TYPE_INTEGER);
    }

    public function down()
    {
        $this->alterColumn('{{%contractor_price}}', 'price', Schema::TYPE_MONEY);
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
