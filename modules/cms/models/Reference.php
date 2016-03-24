<?php

namespace app\modules\cms\models;

use app\modules\cms\components\CategoryBehavior;
use app\modules\cms\components\TranslitBehavior;
use Yii;

/**
 * This is the model class for table "{{%reference}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parentId
 * @property integer $level
 * @property string $alias
 * @property string $metaKeywords
 * @property string $metaDescription
 * @property Reference $parent
 * @see app\modules\cms\components\CategoryBehavior
 */
class Reference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reference}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentId','level'], 'integer'],
            [['title', 'alias','metaDescription','metaKeywords'], 'string', 'max' => 128],
            [['title'],'required'],
            ['alias','unique','targetAttribute'=>['parentId','alias']],
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
            'parentId' => Yii::t('app', 'Раздел'),
            'alias' => Yii::t('app', 'Ярлык'),
            'level' => Yii::t('app', 'Уровень'),
            'metaKeywords' => Yii::t('app', 'Meta слова'),
            'metaDescription' => Yii::t('app', 'Meta описание'),
        ];
    }

    public function behaviors()
    {
        return [
          'Category'=>[
              'class'=>CategoryBehavior::className(),
          ],
            'Translit'=>[
                'class'=>TranslitBehavior::className(),
            ]
        ];
    }

    public function getParent()
    {
        return $this->hasOne(Reference::className(),['id'=>'parentId']);
    }
}
