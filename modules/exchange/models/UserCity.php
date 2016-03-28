<?php

namespace app\modules\exchange\models;

use Yii;

/**
 * This is the model class for table "{{%user_city}}".
 *
 * @property integer $userId
 * @property integer $cityId
 */
class UserCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_city}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'cityId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => Yii::t('app', 'User ID'),
            'cityId' => Yii::t('app', 'City ID'),
        ];
    }
}
