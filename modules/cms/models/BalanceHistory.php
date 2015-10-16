<?php

namespace app\modules\cms\models;

use Yii;

/**
 * This is the model class for table "{{%user_balance_history}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $type
 * @property string $sum
 * @property string $date
 */
class BalanceHistory extends \yii\db\ActiveRecord
{
    const TYPE_ADD = 1;
    const TYPE_REMOVE = 2;
    
    public static function typeList()
    {
        return [
          self::TYPE_ADD => 'Пополнение',
            self::TYPE_REMOVE=>'Списание',
        ];
    }
    
    public function gettypeValue()
    {
        $list = self::typeList();
        return !empty($list[$this->type]) ? $list[$this->type] : ''; 
    }
    
    public function gettypeSum()
    {
        return self::TYPE_ADD == $this->type ? '+'.$this->sum : '-'.$this->sum;  
    }
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return '{{%user_balance_history}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'type'], 'integer'],
            [['userId', 'type', 'sum', 'date'], 'required'],
            [['sum'], 'number'],
            [['date','id'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userId' => Yii::t('app', 'Пользователь'),
            'type' => Yii::t('app', 'Тип операции'),
            'sum' => Yii::t('app', 'Сумма'),
            'typeSum' => Yii::t('app', 'Сумма'),
            'date' => Yii::t('app', 'Дата и время'),
            'typeValue' => Yii::t('app', 'Операция'),
        ];
    }
    
    public static function find()
    {
        return new BalanceHistoryQuery(get_called_class());
    }
    
    public function idList($items)
    {
        $result = [];
        foreach($items as $item)
        {
            if(empty($item->id))
                continue;
            
            $result[]=$item->id;
        }
        return $result;
    }
    
    public function add($userId,$sum,$date,$id=0)
    {
        $this->userId = $userId;
        $this->sum = $sum;
        $this->date = $date;
        $this->type = self::TYPE_ADD;
        $this->id = $id;
        $save = $this->save();
        $this->isNewRecord = true;
        return $save;
    }
    
    public function getBalanceById($userId)
    {
        $data = (object)[
            'add'=>0,
            'remove'=>0,
        ];
        $items = self::find()->where(['userId'=>$userId])->all();
        foreach($items as $item)
        {
            if($item->type == self::TYPE_ADD)
                $data->add += $item->sum;
            elseif($item->type == self::TYPE_REMOVE)
                $data->remove += $item->sum;
        }
        return $data->add - $data->remove;
    }
    
    public static function getByUserId()
    {
        $userId = Yii::$app->user->id;
        $query = self::find();
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$query,
            'sort'=>[
                'defaultOrder'=>['date'=>SORT_ASC],
            ]
        ]);
        $query->andWhere(['userId'=>$userId]);
        return $dataProvider;
    }
}

class BalanceHistoryQuery extends yii\db\ActiveQuery
{
    public function partner($userId)
    {
        $this->andWhere(['userId'=>$userId]);
        return $this;
    }
}
