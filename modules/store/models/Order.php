<?php

namespace app\modules\store\models;
use \Yii;

/**
 * This is the model class for table "{{%store_order}}".
 *
 * @property integer $id
 * @property string $fio
 * @property string $phone
 * @property string $email
 * @property string $dateCreate
 * @property integer $statusId
 * @property string $secretKey
 * @property string $statusTitle
 * @property OrderItem[] $products
 * @property OrderItem[] $items
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW        = '1';
    const STATUS_PROCESSING = '2';
    const STATUS_DONE       = '3';
    const SALT = '$@#RFSDDSFE#F$#';
    public $products;

    public static function statusList()
    {
        return [
          self::STATUS_NEW => 'Новый',
          self::STATUS_PROCESSING => 'В процессе',
          self::STATUS_DONE => 'Закрыт',
        ];
    }

    public function getStatusTitle()
    {
        $list = self::statusList();
        return !empty($list[$this->statusId]) ? $list[$this->statusId] : 'не известно';
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%store_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fio', 'phone', 'email'], 'required'],
            ['email', 'email'],
            [['dateCreate'], 'safe'],
            [['statusId'], 'integer'],
            [['fio'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 23],
            [['email'], 'string', 'max' => 64],
            [['secretKey'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fio' => Yii::t('app', 'ФИО'),
            'phone' => Yii::t('app', 'Телефон'),
            'email' => Yii::t('app', 'Email'),
            'dateCreate' => Yii::t('app', 'Дата и время'),
            'statusId' => Yii::t('app', 'Статус'),
            'secretKey' => Yii::t('app', 'Доступ'),
        ];
    }

    public function make()
    {
        $this->statusId = self::STATUS_NEW;
        $this->dateCreate = date(DATE_FORMAT_DB);
        $this->secretKey = $this->generateSecretKey();
        $this->save();
        foreach ($this->products as $k=>$product) {
            $model = new OrderItem();
            $model->attributes = $product;
            $model->orderId = $this->id;
            $model->save();
            $this->products[$k] = $model;
        }
        return $this;
    }

    protected function generateSecretKey()
    {
        return md5(implode('',$this->attributes).self::SALT.time());
    }

    public static function findBySecretKey($key)
    {
        return self::find()->where(['secretKey'=>$key])->one();
    }

    public function getItems()
    {
        return $this->hasMany(OrderItem::className(),['orderId'=>'id']);
    }

    public function totalCount()
    {
        $count = 0;
        $items = $this->products ? $this->products :  $this->items;

        foreach($items as $item)
        {
            $count += $item->quantity;
        }
        return $count;
    }

    public static function getCount()
    {
        return self::find()->count();
    }
}

