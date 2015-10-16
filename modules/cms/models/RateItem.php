<?php

namespace app\modules\cms\models;

use Yii;

/**
 * This is the model class for table "{{%rate_item}}".
 *
 * @property integer $id
 * @property integer $rateId
 * @property integer $userId
 * @property string $model
 * @property integer $primaryKey
 * @property integer $total
 */
class RateItem extends \yii\db\ActiveRecord
{
    public $total;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rate_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rateId', 'userId', 'primaryKey'], 'integer'],
            [['model'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rateId' => Yii::t('app', 'Рейтинг'),
            'userId' => Yii::t('app', 'Пользователь'),
            'model' => Yii::t('app', 'Модель'),
            'primaryKey' => Yii::t('app', 'Ключ'),
        ];
    }
}
