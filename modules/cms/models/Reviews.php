<?php

namespace app\modules\cms\models;

use app\modules\cms\components\CmsBehavior;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%reviews}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $age
 * @property string $company
 * @property string $content
 * @property string $dateCreate
 * @property string $date
 * @property integer $visible
 * @property \app\modules\cms\models\Image $image
 * @method string imageSrc(string $size = '100x100', string $method = Thumbler::METHOD_NOT_BOXED)
 */
class Reviews extends \yii\db\ActiveRecord
{
    const VISIBLE_OFF = 0;
    const VISIBLE_ON = 1;

    public static function visibleList()
    {
        return [
            self::VISIBLE_OFF => 'Выключен',
            self::VISIBLE_ON => 'Включен',
        ];
    }

    public function getVisibleView()
    {
        $list = self::visibleList();
        return !empty($list[$this->visible]) ? $list[$this->visible] : '';
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reviews}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['age', 'visible'], 'integer'],
            [['name', 'company','dateCreate'], 'string', 'max' => 128],
            [['content'], 'string'],

            [['name','content'],'required','on'=>'site.create'],
            [['dateCreate'],'default','value'=>date(DATE_FORMAT_DB),'on'=>'site.create'],
            ['visible','default','value'=>self::VISIBLE_ON,'on'=>'site.create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Имя'),
            'age' => Yii::t('app', 'Возраст'),
            'company' => Yii::t('app', 'Компания'),
            'content' => Yii::t('app', 'Отзыв'),
            'visible' => Yii::t('app', 'Видимость'),
            'dateCreate' => Yii::t('app', 'Дата добавления'),
        ];
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(), ['primaryKey' => 'id'])
            ->andWhere(['model' => self::className()]);
    }

    public static function find()
    {
        return new ReviewsQuery(get_called_class());
    }

    /**
     * @param $type
     * @return Reviews[]
     */
    public static function getAll()
    {
        return self::find()->all();
    }

    public function behaviors()
    {
        return [
          'cms'=>[
              'class'=>CmsBehavior::className(),
          ]
        ];
    }

    public function getDate()
    {
        return date('d.m.Y H:i', strtotime($this->dateCreate));
    }
}

class ReviewsQuery extends ActiveQuery
{
    public function visible()
    {
        $this->andWhere(['visible'=>Reviews::VISIBLE_ON]);
        return $this;
    }
}