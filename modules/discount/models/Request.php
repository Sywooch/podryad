<?php

namespace app\modules\discount\models;

use app\modules\cms\models\City;
use Yii;
use yii\debug\models\search\Profile;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "{{%discount_request}}".
 *
 * @property integer $id
 * @property string $username
 * @property integer $cityId
 * @property integer $status
 * @property integer $userId
 * @property string $phone
 * @property string $email
 * @property string $dateCreate
 * @property string $dateActivate
 * @property string $type
 * @property City $city
 */
class Request extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_ACCEPT = 1;
    const STATUS_REJECT = 2;
    const STATUS_DONE = 3;
    const TYPE_CLIENT = 'client';
    const TYPE_PARTNER = 'partner';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%discount_request}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'cityId', 'phone', 'email'], 'required'],
            [['email'],'email'],
            [['email'],'unique','message'=>'На этот email уже создана заявка'],
            [['cityId','status','userId'], 'integer'],
            [['status'],'default','value'=>0],
            [['dateCreate', 'dateActivate'], 'safe'],
            [['username', 'phone', 'email','type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'ФИО'),
            'cityId' => Yii::t('app', 'Город'),
            'phone' => Yii::t('app', 'Телефон'),
            'email' => Yii::t('app', 'Email'),
            'dateCreate' => Yii::t('app', 'Дата регистрации'),
            'dateActivate' => Yii::t('app', 'Дата одобрения'),
            'status' => Yii::t('app', 'Статус заявки'),
            'userId' => Yii::t('app', 'Пользователь'),
            'type' => Yii::t('app', 'Тип пользователя'),
        ];
    }

    public function getCity()
    {
        return $this->hasOne(City::className(),['id'=>'cityId']);
    }

    public static function getStatusList()
    {
        return [
          self::STATUS_NEW=>'Новая',
          self::STATUS_ACCEPT=>'Принята в систему',
          self::STATUS_REJECT=>'Отклонена',
          self::STATUS_DONE=>'Обработана',
        ];
    }

    public static function getNewCount()
    {
        return self::find()->where(['status'=>self::STATUS_NEW])->count();
    }

    public function getStatusText()
    {
        $statusList = self::getStatusList();
        return $statusList[$this->status];
    }

    public function reject()
    {
        $this->status = self::STATUS_REJECT;
        return $this->save();
    }

     public function accept()
    {
         $this->dateActivate = date('Y-m-d H:i:s');
        $this->status = self::STATUS_DONE;
        return $this->save();
    }
    
    public function fillData($model)
    {
        /**
         * @var $model \app\modules\cms\models\User
         */
        if($model instanceof \app\modules\cms\models\User){
            $model->username = $this->email;
            $model->role = $this->type;
        }elseif($model instanceof \app\modules\cms\models\Profile)
        {
            $model->cityId = $this->cityId;
            $model->phone = $this->phone;
            $model->name = $this->username;
        }
    }

    public function getTypeList()
    {
        return [
         self::TYPE_PARTNER=>'Партнёр',
         self::TYPE_CLIENT=>'Клиент',
        ];
    }
    
    public function gettypeTitle()
    {
        $list = $this->getTypeList();
        return !empty($list[$this->type]) ? $list[$this->type] : 'не известно';
    }
    
    public function behaviors() {
        return [
            [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'dateCreate',
            'updatedAtAttribute' => false,
            'value'=>new Expression('"'.date('Y-m-d H:i:s').'"'),
            ],
        ];
    }
}
