<?php

use yii\db\Migration;

/**
 * Handles adding h1 to table `{{%user_profile}}`.
 */
class m160528_134942_add_h1_to_user_profile extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%user_profile}}','h1',$this->string(128));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%user_profile}}','h1');
    }
}
