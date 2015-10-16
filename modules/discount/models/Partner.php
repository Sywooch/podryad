<?php

namespace app\modules\discount\models;

use Yii;
use app\modules\cms\components\TranslitBehavior;
use app\modules\cms\components\ItemBehavior;
use yii\helpers\Html;
use yii\web\User;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%discount_partner}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $site
 * @property string $address
 * @property string $workTime
 * @property string $phones
 * @property string $description
 * @property string $metaKeywords
 * @property string $metaDescription
 * @property string $dateCreate
 * @property string $cords
 * @property integer $visible
 * @property integer $parentId
 * @property integer $userId
 * @property \app\modules\cms\models\User $user
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%discount_partner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'],'unique'],
            [['site'],'url'],
            [['description'], 'string'],
            [['dateCreate'], 'safe'],
            [['visible', 'parentId', 'userId'], 'integer'],
            [['parentId'],'default','value'=>0],
            [['title', 'alias', 'site', 'address', 'workTime', 'phones', 'metaKeywords', 'metaDescription','cords'], 'string', 'max' => 255]
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
            'alias' => Yii::t('app', 'Url'),
            'path' => Yii::t('app', 'Url'),
            'site' => Yii::t('app', 'Сайт'),
            'address' => Yii::t('app', 'Адрес'),
            'workTime' => Yii::t('app', 'Рабочее время'),
            'phones' => Yii::t('app', 'Телефоны'),
            'description' => Yii::t('app', 'Содержание'),
            'metaKeywords' => Yii::t('app', 'Ключевые слова'),
            'metaDescription' => Yii::t('app', 'Сео содержание'),
            'dateCreate' => Yii::t('app', 'Дата создания'),
            'visible' => Yii::t('app', 'Видимость'),
            'parentId' => Yii::t('app', 'Категория'),
            'userId' => Yii::t('app', 'Пользователь'),
            'cords' => Yii::t('app', 'Гео координаты'),
        ];
    }

    public function behaviors()
    {
        return [
            'translit'=>[
                'class'=>TranslitBehavior::className(),
            ],
            'item'=>[
                'class'=>ItemBehavior::className(),
                'prefix'=>'discount',
            ],
            [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'dateCreate',
            'updatedAtAttribute' => false,
            'value'=>new Expression('"'.date('Y-m-d H:i:s').'"'),
            ],
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(),['id'=>'parentId']);
    }

    public function getServices()
    {
        return $this->hasMany(Service::className(),['id'=>'parentId']);
    }

    public function afterDelete()
    {
        $serviceList = $this->getServices();

        foreach($serviceList as $service)
            $service->delete();

        return parent::afterDelete();
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'userId']);
    }

    public static function getMapPoints()
    {
        $result = [];
        $items = self::find()->where('cords<>""')->all();
        foreach($items as $item)
        {
            $result[]=['iconContent'=>Html::encode($item->title),'cords'=>'['.$item->cords.']'];
        }
        return $result;
    }
    
    public static function getIdByUserId()
    {
        $userId = \Yii::$app->user->id;
        $item = self::find()->where(['userId'=>$userId])->one();
        if(!$item)
            return false;
        return $item->id;
    }
}
