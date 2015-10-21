<?php

namespace app\modules\cms\models;

use alexBond\thumbler\Thumbler;
use app\modules\cms\components\CmsBehavior;
use app\modules\cms\components\ImageBehavior;
use app\modules\cms\components\Shortext;
use Yii;
use app\modules\cms\components\TranslitBehavior;
use yii\db\ActiveQuery;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $type
 * @property string $alias
 * @property integer $visible
 * @property string $dateCreate
 * @property Image $image
 * @property string $imageSrc
 * @property string $dopText
 * @property string $date
 */
class Article extends \yii\db\ActiveRecord
{
    const TYPE_ARTICLE = 1;
    const TYPE_NEWS = 2;
    const TYPE_STOCK = 3;

    const TYPE_ARTICLE_ALIAS = 'article';
    const TYPE_NEWS_ALIAS = 'news';
    const TYPE_STOCK_ALIAS = 'events';

    const VISIBLE_ON = 1;
    const VISIBLE_OFF = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'dateCreate'], 'required'],
            [['description'], 'string'],
            [['type', 'visible'], 'integer'],
            [['dateCreate'], 'safe'],
            [['title', 'alias','dopText'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Заголовок'),
            'description' => Yii::t('app', 'Содержание'),
            'type' => Yii::t('app', 'Тип'),
            'alias' => Yii::t('app', 'Url'),
            'visible' => Yii::t('app', 'Видимость'),
            'dateCreate' => Yii::t('app', 'Дата и время'),
            'dopText' => Yii::t('app', 'Дополнительный текст'),
        ];
    }

    public static function typeList()
    {
        return [
          self::TYPE_NEWS=>'Новости',
          self::TYPE_STOCK=>'События',
//          self::TYPE_ARTICLE=>'ПОЛЕЗНАЯ ИНФОРМАЦИЯ',
        ];
    }

    public static function typealiasList()
    {
        return [
//            self::TYPE_ARTICLE_ALIAS=>self::TYPE_ARTICLE,
            self::TYPE_NEWS_ALIAS=>self::TYPE_NEWS,
            self::TYPE_STOCK_ALIAS=>self::TYPE_STOCK,
        ];
    }

    public function getTypeView()
    {
        $list = self::typeList();
        return !empty( $list[$this->type] ) ? $list[$this->type] : 'не известно';
    }

    public function behaviors()
    {
        return [
            'translit'=>[
                'class'=>TranslitBehavior::className(),
            ],
            'CmsBehavior'=>[
                'class'=>CmsBehavior::className(),
            ],
            'shortext'=>[
                'class'=>Shortext::className(),
            ],
        ];
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(),['primaryKey'=>'id'])
            ->andWhere(['model'=>self::className()]);
    }

    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }

    public static function getTypeIdByAlias($alias)
    {
        $aliasList = Article::typealiasList();
        return !empty($aliasList[$alias]) ? $aliasList[$alias] : null;
    }

    public function getPath()
    {
        $typeList = self::typealiasList();
        $typeList = array_flip($typeList);
        return Url::to(['/cms/article/view','type'=>$typeList[$this->type],'alias'=>$this->alias]);
    }

    /**
     * @param $type
     * @return Article[]
     */
    public static function getAllByCategory($type)
    {
        return self::find()->type($type)->orderBy(['dateCreate'=>SORT_DESC])->all();
    }

    public static function getOneByCategory($type)
    {
        return self::find()->type($type)->orderBy(['dateCreate' => SORT_DESC])->one();
    }

    /**
     * @return Article[]
     */
    public function getSiblings()
    {
        return self::find()->where(['<>','id',$this->id])->andWhere(['type'=>$this->type])->all();
    }


    public function getDate()
    {
        return \Yii::$app->formatter->asDate(strtotime($this->dateCreate));
    }
}

class ArticleQuery extends ActiveQuery
{
    public function type($type)
    {
        $typeId = Article::getTypeIdByAlias($type);
        $this->where(['type'=>$typeId]);
        return $this;
    }

    public function alias($alias)
    {
        $this->where(['alias'=>$alias]);
        return $this;
    }
}
