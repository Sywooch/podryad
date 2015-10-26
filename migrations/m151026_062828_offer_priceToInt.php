<?php

use yii\db\Schema;
use yii\db\Migration;

class m151026_062828_offer_priceToInt extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%tender_offers}}','price',Schema::TYPE_INTEGER);
    }

    public function down()
    {
        $this->alterColumn('{{%tender_offers}}','price',Schema::TYPE_MONEY);
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
