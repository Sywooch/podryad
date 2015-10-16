<?php

namespace app\modules\store\models;

use Yii;
use app\modules\cms\components\TranslitBehavior;
use app\modules\cms\models\Image;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%store_manufacturer}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property integer $visible
 * @property integer $position
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    const VISIBLE_ON = 1;
    const VISIBLE_OFF = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%store_manufacturer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['visible', 'position'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 128]
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
            'visible' => Yii::t('app', 'Видимость'),
            'position' => Yii::t('app', 'Позиция'),
        ];
    }

    public function behaviors()
    {
        return [
            'translit' => [
                'class' => TranslitBehavior::className(),
            ],
        ];
    }

    public function getPath()
    {
        return Url::to(['/store/category/brand','alias'=>$this->alias]);
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(),['primaryKey'=>'id'])
            ->andWhere(['model'=>self::className()]);
    }

    public static function visibleList()
    {
        return [
            self::VISIBLE_OFF=>'Выключен',
            self::VISIBLE_ON=>'Включен',
        ];
    }

    public function getvisibleDisplay()
    {
        $list = self::visibleList();
        return !empty($list[$this->visible]) ? $list[$this->visible] : 'не известно(ошибка)';
    }

    public static function dropDown()
    {
        $items = self::find()->all();
        return ArrayHelper::map($items,'id','title');
    }

    public static function getCount()
    {
        return self::find()->count();
    }

    /**
     * @return Category[]
     */
    public static function getNavigationData()
    {
        $items = self::find()->visible()->orderBy('position ASC')->all();
        return $items;
    }

    public static function find()
    {
        return new ManufacturerQuery(get_called_class());
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(),['manufacturerId'=>'id']);
    }

    public static function getFirstLink()
    {
        $item = self::find()->orderBy(['position'=>SORT_ASC])->visible()->one();
        return ['/store/category/brand','alias'=>$item->alias];
    }
}

class ManufacturerQuery extends ActiveQuery
{
    public function visible()
    {
        $this->andWhere(['visible'=>Manufacturer::VISIBLE_ON]);
        return $this;
    }
}