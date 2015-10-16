<?php

namespace app\modules\cms\models;

use app\modules\exchange\models\Contactor;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "iv_rate".
 *
 * @property integer $id
 * @property string $title
 * @property string $key
 * @property integer $position
 * @property RateItem[] $rateList
 */
class Rate extends \yii\db\ActiveRecord
{
    public $model;
    public $primaryKey;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iv_rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position'], 'integer'],
            [['title'], 'string', 'max' => 128],
            ['title','required','on'=>'create'],
            [['id','model','primaryKey'],'required','on'=>'rate'],
            ['id','checkUser','on'=>'rate'],
        ];
    }

    public function checkUser()
    {
        if(\Yii::$app->user->isGuest)
        {
            return $this->addError('id','Рейтинг доступен только для зарегистрированных пользователей');
        }

        if(\Yii::$app->user->id == $this->primaryKey)
        {
            return $this->addError('id','Вы не можете голосовать за самого себя');
        }

        $model = RateItem::find()->where(['userId'=>\Yii::$app->user->id,'model'=>$this->model,'primaryKey'=>$this->primaryKey])->one();

        if($model)
            return $this->addError('id','Вы уже голосовали');

        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'totalRate' => Yii::t('app', 'Общее кол-во'),
            'position' => Yii::t('app', 'Позиционирование'),
        ];
    }

    public function rate()
    {
        $model = new RateItem();
        $model->rateId = $this->id;
        $model->userId = \Yii::$app->user->id;
        $model->model = $this->model;
        $model->primaryKey = $this->primaryKey;
        $model->save();
    }

    public function isBearing()
    {
        if(\Yii::$app->user->isGuest)
            return true;

        $model = RateItem::findOne(['userId'=>\Yii::$app->user->id,'primaryKey'=>$this->primaryKey,'model'=>$this->model]);
        return $model ? true : false;
    }

    public static function find()
    {
        return new RateQuery(get_called_class());
    }

    static $_items = [];

    public function getTotalRate($className,$primaryKey)
    {
        if(isset(self::$_items[$this->id][$primaryKey]))
        {
            return self::$_items[$this->id][$primaryKey];
        }

        $modelList = self::find()->select('id')->all();
        $rateIds = [];
        foreach($modelList as $model)
            $rateIds[$model->id]=$model->id;

        $items = RateItem::find()->select('count(id) as total, rateId,primaryKey')->where(['model'=>$className])->groupBy(['rateId','primaryKey','model'])->all();

        if(empty($items))
        {
            foreach($rateIds as $rateId)
            {
                self::$_items[$rateId][$primaryKey] = 0;
            }
        }
        else
        {
            foreach ($items as $item)
                self::$_items[$item->rateId][$item->primaryKey] = $item->total;
        }


        foreach($rateIds as $rateId)
        {
            if(!isset(self::$_items[$rateId][$primaryKey]))
                self::$_items[$rateId][$primaryKey] = 0;
        }

        return $this->getTotalRate($className,$primaryKey);
    }
}

class RateQuery extends ActiveQuery
{
    public function ordered()
    {
        $this->orderBy(['position'=>SORT_ASC]);
        return $this;
    }
}
