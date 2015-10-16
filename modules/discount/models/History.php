<?php

namespace app\modules\discount\models;

use app\modules\cms\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%discount_history}}".
 *
 * @property integer $id
 * @property integer $serviceId
 * @property integer $userId
 * @property string $dateUse
 * @property Service $service
 * @property User $user
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%discount_history}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serviceId', 'userId'], 'required'],
            [['serviceId', 'userId'], 'integer'],
            [['dateUse'], 'safe'],
            [['dateUse'],'required','on'=>'search']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'serviceId' => Yii::t('app', 'Услуга'),
            'userId' => Yii::t('app', 'Пользователь'),
            'dateUse' => Yii::t('app', 'Дата использования'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'userId']);
    }

    public function getService()
    {
        return $this->hasOne(Service::className(),['id'=>'serviceId']);
    }

    public function findByUserId($userId)
    {
        $query =  self::find()->innerJoinWith(['user','service'])->where(['userId'=>$userId]);
        if($this->dateUse)
        {
            $query->andFilterWhere(['like','dateUse',$this->dateUse]);
        }
        $query->orderBy('dateUse DESC');
        return $query->all();
    }
    
    public function findByPartnerId($parentId)
    {
        $query = self::find();
        $query->innerJoinWith(['service','user']);
        
        $serviceTable = Service::tableName();
        
        $query->where([$serviceTable.'.parentId'=>$parentId]);
        if(!empty($this->dateUse))
        {
            $query->andFilterWhere(['like','dateUse',$this->dateUse]);
        }
        return $query->all();
    }
    
    public function behaviors() {
        return [
          [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'dateUse',
            'updatedAtAttribute' => false,
            'value'=>new Expression('"'.date('Y-m-d H:i:s').'"'),
            ],
        ];
    }
}
