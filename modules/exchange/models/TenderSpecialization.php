<?php

namespace app\modules\exchange\models;

use Yii;

/**
 * This is the model class for table "{{%tender_specialization}}".
 *
 * @property integer $specializationId
 * @property integer $tenderId
 */
class TenderSpecialization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tender_specialization}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['specializationId', 'tenderId'], 'required'],
            [['specializationId', 'tenderId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'specializationId' => Yii::t('app', 'Specialization ID'),
            'tenderId' => Yii::t('app', 'Tender ID'),
        ];
    }
}
