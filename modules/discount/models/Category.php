<?php

namespace app\modules\discount\models;

use Yii;
use app\modules\cms\components\CategoryBehavior;
use app\modules\cms\components\TranslitBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%discount_category}}".
 *
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $metaKeywords
 * @property string $metaDescription
 * @property string $dateCreate
 * @property integer $visible
 * @property integer $parentId
 */
class Category extends \yii\db\ActiveRecord
{
    public $level;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%discount_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'unique'],
            [['description'], 'string'],
            [['dateCreate'], 'safe'],
            [['visible', 'parentId'], 'integer'],
            [['parentId'],'default','value'=>0],
            [['title', 'alias', 'metaKeywords', 'metaDescription'], 'string', 'max' => 255]
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
            'description' => Yii::t('app', 'Содержание'),
            'metaKeywords' => Yii::t('app', 'Ключевые слова'),
            'metaDescription' => Yii::t('app', 'Сео описание'),
            'dateCreate' => Yii::t('app', 'Дата создания'),
            'visible' => Yii::t('app', 'Видимость'),
            'parentId' => Yii::t('app', 'Категория'),
        ];
    }

    public function behaviors()
    {
        return [
            'translit'=>[
                'class'=>TranslitBehavior::className(),
            ],
            'category'=>[
                'class'=>CategoryBehavior::className(),
                'prefix'=>'discount',
                'itemParentField'=>'categoryId',
                'itemClass'=>'app\modules\discount\models\Service',
                'itemWith'=>['image','category'],
                'route'=>'discount/default/category',
            ],
            [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'dateCreate',
            'updatedAtAttribute' => false,
            'value'=>new Expression('"'.date('Y-m-d H:i:s').'"'),
            ],
        ];
    }

    public function afterDelete()
    {
        return parent::afterDelete();
    }
}
