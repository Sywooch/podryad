<?php

use yii\db\Migration;

/**
 * Handles adding phone2_phone3 to table `user_profile`.
 */
class m160519_034135_add_phone2_phone3_to_user_profile extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%user_profile}}','phone2',\yii\db\Schema::TYPE_STRING);
        $this->addColumn('{{%user_profile}}','phone3',\yii\db\Schema::TYPE_STRING);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%user_profile}}', 'phone2');
        $this->dropColumn('{{%user_profile}}', 'phone3');
        return true;
    }
}
