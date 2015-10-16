<?php

namespace app\modules\cms\models;

use Yii;

/**
 * This is the model class for table "{{%price}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $price
 * @property string $object
 * @property integer $objectId
 * @property Page $obj
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objectId'], 'required'],
            [['objectId'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['price'], 'string', 'max' => 32],
            [['object'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'price' => Yii::t('app', 'Цена'),
            'object' => Yii::t('app', 'Объект'),
            'objectId' => Yii::t('app', 'Ключ обьекта'),
        ];
    }

    public static function findByObject($object,$objectId)
    {
        return self::find()->where(['object'=>$object,'objectId'=>$objectId])->one();
    }

    public function getObj()
    {
        $object= $this->object;
        return $this->hasOne($object::className(),['id'=>'objectId']);
    }
}
