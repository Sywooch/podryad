<?php

use yii\db\Schema;
use yii\db\Migration;

class m151027_072712_tenderSpecialization extends Migration
{
    public function up()
    {
        $this->createTable('{{%tender_specialization}}',[
           'tenderId'=>Schema::TYPE_INTEGER,
            'specializationId'=>Schema::TYPE_INTEGER,
        ]);
        $this->addPrimaryKey('key','{{%tender_specialization}}',['tenderId','specializationId']);

        $tenderList = \app\modules\exchange\models\Tender::find()->select('specializationId,id')->where(['<>','specializationId',''])->all();
        foreach($tenderList as $tender)
        {
            /** @var $tender \app\modules\exchange\models\Tender */
            $specialization = \app\modules\cms\models\Reference::findOne($tender->specializationId);
            if($specialization)
            {
                $tender->link('specializations',$specialization);
            }
        }
    }

    public function down()
    {
        $this->dropTable('{{%tender_specialization}}');
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
