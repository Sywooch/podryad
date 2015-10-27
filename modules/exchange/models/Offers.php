<?php

namespace app\modules\exchange\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%tender_offers}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $dateAdd
 * @property string $price
 * @property string $description
 * @property string $rateStatus
 * @property string $selectedText
 * @property string $date
 * @property integer $tenderId
 * @property integer $rate
 * @property User $user
 * @property Tender $tender
 */
class Offers extends \yii\db\ActiveRecord
{
    public $rateList = [
        0 => 'Так себе 0',
        1 => 'Средне 1',
        6 => 'Хорошо 6',
        15 => 'Супер 15',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tender_offers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'tenderId', 'rate'], 'integer'],
            [['dateAdd'], 'safe'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['price','description','userId','tenderId'],'required','on'=>'new'],
            ['price', 'number'],
            ['dateAdd','default','value'=>date(DATE_FORMAT_DB)],
            ['rate','in','range'=>array_keys($this->rateList),'on'=>'rateSet'],
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
            'dateAdd' => Yii::t('app', 'Дата Добавления'),
            'price' => Yii::t('app', 'Стоимость работ'),
            'description' => Yii::t('app', 'Описание работ'),
            'tenderId' => Yii::t('app', 'Тендер'),
            'rate' => Yii::t('app', 'Оценка'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Contactor::className(), ['id' => 'userId']);
    }

    public function rateUrl($rate)
    {
        return Url::to(['/exchange/offers/rate-set','id'=>$this->id,'rate'=>$rate]);
    }

    public function rateSet($rate)
    {
        $this->rate = $rate;
        $this->scenario = 'rateSet';
        return $this->save();
    }

    public function getRateStatus()
    {
        return !empty($this->rateList[$this->rate]) ? $this->rateList[$this->rate] : '';
    }

    public function getTender()
    {
        return $this->hasOne(Tender::className(),['id'=>'tenderId']);
    }

    public function getSelectedText()
    {
        return $this->tender->contractorId == $this->userId  ? 'Подрядчик выбран в качестве исполнителя' : '';
    }

    public function getDate()
    {
        return date('d.m.Y H:i', strtotime($this->dateAdd));
    }
}


