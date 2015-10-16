<?php

namespace app\modules\cms\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property integer $id
 * @property string $title
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'],'unique'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Код'),
            'title' => Yii::t('app', 'Город'),
        ];
    }

    public static function dropDown()
    {
        return ArrayHelper::map(
            self::find()->all(),
            'id',
            'title'
        );
    }
}
