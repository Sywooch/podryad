<?php

namespace app\modules\discount\models;

use app\modules\cms\models\User;
use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%discount_card}}".
 *
 * @property integer $id
 * @property string $cvcode
 * @property string $dateCreate
 * @property string $datePrint
 * @property string $dateActivate
 * @property string $number
 * @property integer $status
 * @property integer $type
 * @property integer $userId
 * @property \app\modules\cms\models\User $user
 */
class Card extends \yii\db\ActiveRecord
{
    public $relationFile;
    const STATUS_NEW = 0;
    const STATUS_PRINT = 1;
    const STATUS_MODER = 2;
    const STATUS_ACTIVE = 3;
    const CARD_DIR = 'download/card';
    const TYPE_SILVER = 0;
    const TYPE_GOLD = 1;
    const TYPE_PLATINUM = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%discount_card}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['relationFile','file','on'=>'relation'],
            ['cvcode','exist','targetAttribute'=>'cvcode','message'=>'Вы ввели неверный код карты','on'=>'form'],
            [['cvcode'], 'required'],
            [['dateCreate', 'datePrint', 'dateActivate'], 'safe'],
            [['status', 'userId','type'], 'integer'],
            ['type','default','value'=>self::TYPE_SILVER],
            [['cvcode'], 'string', 'max' => 24]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cvcode' => Yii::t('app', 'Код'),
            'dateCreate' => Yii::t('app', 'Дата создания'),
            'datePrint' => Yii::t('app', 'Дата печати'),
            'dateActivate' => Yii::t('app', 'Дата активации'),
            'status' => Yii::t('app', 'Статус'),
            'userId' => Yii::t('app', 'Пользователь'),
            'type' => Yii::t('app', 'Тип карты'),
            'relationFile' => Yii::t('app', 'Файл для связки'),
            'number' => Yii::t('app', 'Номер'),
        ];
    }

    public function generateCard($id)
    {
        $key = Yii::$app->params['cardSecretKey'];
        $hash = hash('sha256', $id);
        $results = [];
        $result = '';
        for ($i = 0; $i < 20; $i++) {
            $result .= $hash{$i};
            if (($i + 1) % 4 == 0) {
                $results[] = $result;
                $result = '';
            }
        }
        return mb_strtoupper(implode('-', $results));
    }

    public function getMaxId()
    {
        return self::find()->select(['max(id) as id'])->one();
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_NEW => 'Новая',
            self::STATUS_PRINT => 'Распечатанная',
            self::STATUS_MODER => 'На модерации',
            self::STATUS_ACTIVE => 'Активированная',
        ];
    }

    public function getStatusText()
    {
        $statuses = self::getStatusList();
        return $statuses[$this->status];
    }

    public static function find()
    {
        return new CardQuery(get_called_class());
    }

    public function getPath()
    {
        return Url::to(['/discount/default/card', 'cvcode' => $this->cvcode]);
    }

    public function toPrint()
    {
        $this->status = self::STATUS_PRINT;
        $this->datePrint = date('Y-m-d H:i:s');
        $this->save(false, ['status']);
    }

    public function getFullurl()
    {
        return Yii::$app->params['cardDomen'] . $this->getPath();
    }

    public static function findByCvcode($cvcode)
    {
        return self::find()->where(['cvcode' => $cvcode])->one();
    }

    public function isModerOrActivate()
    {
        return in_array($this->status, [self::STATUS_ACTIVE, self::STATUS_MODER]);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public static function getTypeList()
    {
        return [
            self::TYPE_SILVER => 'Silver',
            self::TYPE_GOLD => 'Gold',
            self::TYPE_PLATINUM => 'Platinum',
        ];
    }

    public function getTypeValue()
    {
        $list = self::getTypeList();
        return !empty($list[$this->type]) ? $list[$this->type] : 'не проставлен';
    }
    
    public function insertNumber($number)
    {
        $this->number = $number;
        $this->save(false,['number']);
    }
    
    public static function getLinkByUser()
    {
        $userId = \Yii::$app->user->id;
        if(!$userId)
            return false;
        
        $card = self::find()->where(['userId'=>$userId])->one();
        if(!$card)
        {
          return FALSE;
        }
           
        return Url::to(['/discount/default/card','cvcode'=>$card->cvcode]);
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

class CardQuery extends \yii\db\ActiveQuery
{

    public function newCard()
    {
        return $this->andWhere(['status' => \app\modules\discount\models\Card::STATUS_NEW]);
    }

}
