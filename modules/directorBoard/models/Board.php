<?php

namespace app\modules\directorBoard\models;

use app\modules\cms\components\CmsBehavior;
use app\modules\cms\components\ImageBehavior;
use app\modules\cms\components\Shortext;
use app\modules\cms\components\TranslitBehavior;
use app\modules\cms\models\Image;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%director_board}}".
 *
 * @property integer $id
 * @property integer $categoryId
 * @property string $category
 * @property string $title
 * @property string $post
 * @property string $content
 * @property string $alias
 * @property string $path
 * @property Image $image
 * @method string imageSrc(string $size = '100x100', string $method = Thumbler::METHOD_NOT_BOXED)
 */
class Board extends \yii\db\ActiveRecord
{
    const CATEGORY_AMKADOR_HOLDING = 1;
    const CATEGORY_AMKADOR_ASTANA = 2;

    public static function categoryList()
    {
        return [
            self::CATEGORY_AMKADOR_HOLDING=>'ХОЛДИНГ "АМКОДОР"',
            self::CATEGORY_AMKADOR_ASTANA=>'АМКОДОР-АСТАНА',
        ];
    }

    public function getCategory(){
        $list = self::categoryList();
        return !empty($list[$this->categoryId]) ? $list[$this->categoryId] : 'не задана';
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%director_board}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','post'],'required'],
            [['content'], 'string'],
            ['categoryId','integer'],
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
            'title' => Yii::t('app', 'ФИО'),
            'content' => Yii::t('app', 'Полный текст'),
            'alias' => Yii::t('app', 'Alias'),
            'post' => Yii::t('app', 'Должность'),
            'categoryId' => Yii::t('app', 'Категория'),
        ];
    }

    public function behaviors()
    {
        return [
            'translit'=>[
                'class'=>TranslitBehavior::className(),
            ],
            'image'=>[
                'class'=>ImageBehavior::className(),
            ],
            'shortext'=>[
                'class'=>Shortext::className(),
                'attribute'=>'content',
            ],
            'cms' => [
                'class' => CmsBehavior::className(),
            ],
        ];
    }

    public function getPath()
    {
        return Url::to(['/directorBoard/default/view','alias'=>$this->alias]);
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(),['primaryKey'=>'id'])
            ->andWhere(['model'=>self::className()]);
    }

    public static function findByCategory($id)
    {
        return self::find()->where(['categoryId'=>$id])->all();
    }

    public function afterDelete()
    {
        $this->image->delete();
        return parent::afterDelete();
    }

    /**
     * @return Board[]
     */
    public static function getAll()
    {
        return self::find()->all();
    }

    public static function personalList()
    {
        $items = self::find()->all();
        return ArrayHelper::map($items,'id','title');
    }
}
