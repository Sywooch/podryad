<?php

namespace app\modules\exchange\models;

use Yii;

/**
 * This is the model class for table "{{%user_specialization}}".
 *
 * @property integer $userId
 * @property integer $specializationId
 */
class UserSpecialization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_specialization}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'specializationId'], 'required'],
            [['userId', 'specializationId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => Yii::t('app', 'User ID'),
            'specializationId' => Yii::t('app', 'Specialization ID'),
        ];
    }
}
