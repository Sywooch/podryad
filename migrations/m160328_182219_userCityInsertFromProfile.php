<?php

use yii\db\Schema;
use yii\db\Migration;

class m160328_182219_userCityInsertFromProfile extends Migration
{
    public function up()
    {
        \app\modules\exchange\models\UserCity::deleteAll();
        $items = \app\modules\cms\models\Profile::find()->select(['userId','cityId'])->all();

        foreach($items as $item)
        {
            $model = new \app\modules\exchange\models\UserCity();
            if(empty($item->cityId))
                continue;

            $model->userId = $item->userId;
            $model->cityId = $item->cityId;
            $model->save();
        }
    }

    public function down()
    {
        \app\modules\exchange\models\UserCity::deleteAll();
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
