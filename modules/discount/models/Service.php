<?php

namespace app\modules\discount\models;

use app\modules\cms\components\ItemBehavior;
use app\modules\cms\components\TranslitBehavior;
use app\modules\cms\models\Image;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%discount_service}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $discount
 * @property string $description
 * @property integer $parentId
 * @property integer $categoryId
 * @property string $alias
 * @property \app\modules\cms\models\Image $image
 * @property \app\modules\discount\models\Partner $category
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%discount_service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'discount'], 'required'],
            [['discount'], 'number'],
            [['description'], 'string'],
            [['parentId','categoryId'], 'integer'],
            [['title','alias'], 'string', 'max' => 255]
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
            'discount' => Yii::t('app', 'Скидка'),
            'parentId' => Yii::t('app', 'Parent ID'),
            'image' => Yii::t('app', 'Изображение'),
            'category' => Yii::t('app', 'Категория'),
            'description' => Yii::t('app', 'Описание'),
            'alias' => Yii::t('app', 'Url'),
        ];
    }

    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination'=>[
                'pageSize'=>\Yii::$app->params['pageSize'],
            ]
        ]);
        $this->load($params);

        $query->andFilterWhere([
            'id'=>$this->id,
           'discount'=>$this->discount
        ]);

        $query->andFilterWhere(['like','title',$this->title]);
        $query->andFilterWhere(['parentId'=>$this->parentId]);

        return $dataProvider;
    }

    protected function getImage()
    {
        return $this->hasOne(Image::className(),[
           'primaryKey'=>'id'
        ])->andFilterWhere([
            'model'=>self::className(),
        ]);
    }

    protected function getImages()
    {
        return $this->hasMany(Image::className(),[
            'primaryKey'=>'id'
        ])->andFilterWhere([
            'model'=>self::className(),
        ]);
    }

    /**
     * @return Image
     */
    public function image()
    {
        $image = $this->image;
        return $image ? $image : new Image();
    }

    public function getCategory()
    {
        return $this->hasOne(Partner::className(),[
           'id'=>'parentId',
        ]);
    }

    public function behaviors()
    {
        return [
              'item'=>[
                  'class'=>ItemBehavior::className(),
                  'prefix'=>'discount/service/'
              ],
             'translit'=>[
               'class'=>TranslitBehavior::className(),
             ],
        ];
    }

    public function getPartner()
    {
        return $this->hasMany(Partner::className(),[
           'id'=>'parentId',
        ]);
    }

    public static function findByUserId($userId)
    {
        return self::find()->joinWith('partner')->where(['iv_discount_partner.userId'=>$userId])->all();
    }
}
