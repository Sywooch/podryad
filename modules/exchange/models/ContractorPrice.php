<?php

namespace app\modules\exchange\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%contractor_price}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $title
 * @property string $price
 */
class ContractorPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contractor_price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId'], 'integer'],
            [['price'], 'number'],
            [['title'], 'string', 'max' => 300],
            [['userId','title','price'],'required'],
            [['title'],'unique','targetAttribute'=>['userId','title']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userId' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Название'),
            'price' => Yii::t('app', 'Цена'),
        ];
    }

    public static function find()
    {
        return new ContractorPriceQuery(get_called_class());
    }
}

class ContractorPriceQuery extends ActiveQuery
{
    public function priceOrder($direction = SORT_ASC)
    {
        $this->orderBy(['price'=>$direction]);
        return $this;
    }
}