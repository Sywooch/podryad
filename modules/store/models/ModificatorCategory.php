<?php

namespace app\modules\store\models;

use app\modules\cms\components\TranslitBehavior;
use app\modules\cms\models\Image;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%product_modificator_category}}".
 *
 * @property integer $id
 * @property integer $productId
 * @property Product $product
 * @property Category $category
 * @property ModificatorItem[] $items
 * @property Image $image
 * @property integer $categoryId
 * @property string $title
 * @property string $titleLink
 * @property string $alias
 * @property string $memo
 */
class ModificatorCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_modificator_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'categoryId'], 'integer'],
            [['title', 'titleLink', 'alias', 'memo'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'productId' => Yii::t('app', 'Товар'),
            'categoryId' => Yii::t('app', 'Категория'),
            'title' => Yii::t('app', 'Название'),
            'titleLink' => Yii::t('app', 'Название ссылки'),
            'alias' => Yii::t('app', 'Url'),
            'memo' => Yii::t('app', 'Дополнительная информация'),
        ];
    }

    public  function beforeDelete()
    {
        ModificatorItem::deleteAll(['categoryId'=>$this->id]);
        return parent::beforeDelete();
    }

    public function behaviors()
    {
        return [
            'translit' => [
                'class' => TranslitBehavior::className(),
            ],
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(),['id'=>'productId']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(),['id'=>'categoryId']);
    }

    public function getItems()
    {
        return $this->hasMany(ModificatorItem::className(),['categoryId'=>'id']);
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(),['primaryKey'=>'id'])
            ->andWhere(['model'=>self::className()]);
    }

    public function getPath()
    {
        return Url::to(['/store/product/modificator','productAlias'=>$this->product->alias,'categoryAlias'=>$this->category->alias,'id'=>$this->id]);
    }
}
