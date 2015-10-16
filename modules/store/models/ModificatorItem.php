<?php

namespace app\modules\store\models;

use Yii;

/**
 * This is the model class for table "{{%product_modificator_item}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $categoryId
 */
class ModificatorItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_modificator_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId','title','content'],'required'],
            [['categoryId'], 'integer'],
            [['title', 'content'], 'string', 'max' => 128]
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
            'content' => Yii::t('app', 'Значение'),
            'categoryId' => Yii::t('app', 'Категория'),
        ];
    }
}
