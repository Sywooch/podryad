<?php

namespace app\modules\store\models;

use app\modules\cms\components\Shortext;
use app\modules\store\components\BasketBehavior;
use Yii;
use app\modules\cms\models\Image;
use app\modules\cms\components\TranslitBehavior;
use yii\db\ActiveQuery;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%store_product}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property integer $categoryId
 * @property integer $manufacturerId
 * @property string $content
 * @property integer $minCount
 * @property integer $quantity
 * @property integer $visible
 * @property string $path
 * @property string $modificatorLink
 * @property ModificatorCategory[] $modificators
 * @property Image $image
 * @property Category $category
 * @property Manufacturer $manufacturer
 */
class Product extends \yii\db\ActiveRecord
{
    const VISIBLE_ON = 1;
    const VISIBLE_OFF = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%store_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId'], 'required'],
            [['categoryId', 'manufacturerId', 'minCount', 'quantity', 'visible'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 128],
            [['content'], 'string']
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
            'categoryId' => Yii::t('app', 'Категория'),
            'manufacturerId' => Yii::t('app', 'Производитель'),
            'content' => Yii::t('app', 'Описание'),
            'minCount' => Yii::t('app', 'Минимальный заказ'),
            'quantity' => Yii::t('app', 'Кол-во на складе'),
            'visible' => Yii::t('app', 'Видимость'),
        ];
    }

    public function behaviors()
    {
        return [
            'translit' => [
                'class' => TranslitBehavior::className(),
            ],
            'basket' => [
                'class' => BasketBehavior::className(),
            ],
            'shortext'=>[
                'class'=>Shortext::className(),
                'attribute'=>'content',
            ],
        ];
    }

    public function getPath()
    {
        return Url::to(['/store/product/view','category'=>$this->category->alias,'alias'=>$this->alias]);
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

    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'categoryId']);
    }

    public function getManufacturer(){
        return $this->hasOne(Manufacturer::className(),['id'=>'manufacturerId']);
    }

    public static function getCount()
    {
        return self::find()->count();
    }

    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    /**
     * @param $obj ProductQuery
     * @param $q
     */
    public function siteSearch($obj, $q)
    {
        if(!empty($q))
        {
            $obj->andWhere(['like','title',$q]);
        }
        return $obj;
    }

    public function getModificatorLink()
    {
        return Url::to(['/store/product/modificator','productAlias'=>$this->alias,'categoryAlias'=>$this->category->alias]);
    }

    public function getModificators()
    {
        return $this->hasMany(ModificatorCategory::className(),['productId'=>'id']);
    }
}

class ProductQuery extends ActiveQuery
{
    public function visible()
    {
        $this->andWhere(['visible'=>Product::VISIBLE_ON]);
        $this->andWhere(['>','quantity',0]);
        return $this;
    }
}
