<?php

use yii\db\Schema;
use yii\db\Migration;

class m160328_152018_user_city extends Migration
{
    public function up()
    {
        $this->createTable('{{%user_city}}',[
           'userId'=>Schema::TYPE_INTEGER,
           'cityId'=>Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        return $this->dropTable('{{%user_city}}');
    }
}
