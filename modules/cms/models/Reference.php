<?php

namespace app\modules\cms\models;

use app\modules\cms\components\CategoryBehavior;
use app\modules\cms\components\TranslitBehavior;
use Yii;
use yii\helpers\Url;

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

    public function getUrl()
    {
        $url = $this->getFullPath(true);

        if (!empty(\Yii::$app->request->cookies['city'])) {
            $cityId = \Yii::$app->request->cookies['city'];
            $model = Reference::findOne($cityId);

            if ($model && $model->alias != 'ves-kazahstan') {
                $url = $url . '/' . $model->alias;
            }
        }

        return Url::to(['/exchange/contractor/index','path'=>$url]);
    }

    public static function getCityList()
    {
        $result = [];
        $modelList = Reference::findOne(['alias' => 'cityList'])->children();
        foreach($modelList as $model)
        {
            if($model->alias == 'ves-kazahstan')
                continue;

            $result[]=$model;
        }
        return $result;
    }

    public static function url($url)
    {
        if (!empty(\Yii::$app->request->cookies['city'])) {
            $cityId = \Yii::$app->request->cookies['city'];
            $model = Reference::findOne($cityId);
            if($model && $model->alias != 'ves-kazahstan')
                $url = $url . '/' . $model->alias;
        }
        return Url::to(['/exchange/contractor/index', 'path' => $url]);
    }

    public function breadcrumbs()
    {
        $parents = $this->parents();
        if(sizeof($parents)==1)
        {
            return [
                ['label' => $this->title]
            ];
        }else{
            $root = $parents[1];
            return [
                ['label' => $root->title, 'url' => ['/exchange/contractor/index', 'path' => $root->getFullPath(true)]],
                ['label' => $this->title]
            ];
        }
    }
}
