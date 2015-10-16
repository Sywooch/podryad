<?php

namespace app\modules\cms\models;

use app\modules\cms\components\CategoryBehavior;
use app\modules\cms\components\TranslitBehavior;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $metaKeywords
 * @property string $metaDescription
 * @property string $dateCreate
 * @property integer $visible
 * @property string $systemName
 * @property integer $parentId
 * @property integer $level;
 * @property string $FullTitle
 * @property string $path
 */

class Category extends ActiveRecord
{
    public $level;
    CONST HIDDEN = 1;
    CONST VISIBLE = 1;
    CONST ALL = 0;
    CONST DIR = 1;
    CONST ITEM = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            ['parentId','default','value'=>0],
            [['dateCreate'], 'safe'],
            [['visible', 'parentId'], 'integer'],
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
            'title' => Yii::t('app', 'Title'),
            'alias' => Yii::t('app', 'Alias'),
            'description' => Yii::t('app', 'Description'),
            'metaKeywords' => Yii::t('app', 'Meta Keywords'),
            'metaDescription' => Yii::t('app', 'Meta Description'),
            'dateCreate' => Yii::t('app', 'Date Create'),
            'visible' => Yii::t('app', 'Visible'),
            'systemName' => Yii::t('app', 'System Name'),
            'parentId' => Yii::t('app', 'Parent ID'),
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
                'prefix'=>'shop',
                'itemClass'=>'app\modules\cms\models\Page',
            ],
            [
            'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'dateCreate',
                'updatedAtAttribute' => false,
                'value'=>new Expression('"'.date('Y-m-d H:i:s').'"'),
            ],
        ];
    }
    
   
}
