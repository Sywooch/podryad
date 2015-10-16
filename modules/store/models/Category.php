<?php

namespace app\modules\store\models;


use Yii;
use app\modules\cms\models\Image;
use app\modules\cms\components\TranslitBehavior;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%store_category}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $path
 * @property string $modificatorTitle
 * @property Image $image
 * @property ModificatorCategory $modificator
 * @property integer $visible
 * @property integer $position
 * @property Product[] $products
 * @property Product $product
 */
class Category extends \yii\db\ActiveRecord
{
    const VISIBLE_ON = 1;
    const VISIBLE_OFF = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%store_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['visible', 'position'], 'integer'],
            [['title', 'alias','modificatorTitle'], 'string', 'max' => 128]
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
            'modificatorTitle' => Yii::t('app', 'Заголовок модификатора'),
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
        return Url::to(['/store/category/view','alias'=>$this->alias]);
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
        return new CategoryQuery(get_called_class());
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(),['categoryId'=>'id']);
    }

    public static function getFirstLink()
    {
        $item = self::find()->orderBy(['position'=>SORT_ASC])->visible()->one();
        return ['/store/category/view','alias'=>$item->alias];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(),['categoryId'=>'id']);
    }

    public function getModificatorLink()
    {
        $product = $this->product;
        return $product ?  $product->modificatorLink : '#';
    }
}

class CategoryQuery extends ActiveQuery
{
    public function visible()
    {
        $this->andWhere(['visible'=>Category::VISIBLE_ON]);
        return $this;
    }
}