<?php

namespace app\modules\store\models;

use Yii;

/**
 * This is the model class for table "{{%store_order_item}}".
 *
 * @property integer $id
 * @property integer $orderId
 * @property integer $productId
 * @property integer $quantity
 * @property Product $product
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%store_order_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'productId', 'quantity'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'orderId' => Yii::t('app', 'Заказ'),
            'productId' => Yii::t('app', 'Товар'),
            'quantity' => Yii::t('app', 'Кол-во'),
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(),['id'=>'productId']);
    }
}
