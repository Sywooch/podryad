<?php

namespace app\modules\forum\models;

use app\modules\cms\components\CmsBehavior;
use app\modules\cms\components\TranslitBehavior;
use app\modules\cms\models\Image;
use app\modules\cms\models\User;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%forum_item}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $dateCreate
 * @property string $alias
 * @property string $path
 * @property integer $authorId
 * @property integer $answerCount
 * @property User $author
 * @property Answer[] $answerList
 * @method string imageSrc(string $size = '100x100', string $method = Thumbler::METHOD_NOT_BOXED)
 */
class Item extends \yii\db\ActiveRecord
{
    public $photo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forum_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','dateCreate','authorId'],'required'],
            [['description'], 'string'],
            [['dateCreate'], 'safe'],
            [['title', 'alias'], 'string', 'max' => 128],
            [['title','alias'],'unique','message'=>'Данные вопрос уже существует'],
            ['photo','file','on'=>'front.create'],
            ['authorId','default','value'=>Yii::$app->user->id],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Вопрос'),
            'description' => Yii::t('app', 'Краткое описание'),
            'dateCreate' => Yii::t('app', 'Дата создания'),
            'alias' => Yii::t('app', 'Url'),
            'authorId' => Yii::t('app', 'Автор'),
            'photo' => Yii::t('app', 'Фото беседы'),
        ];
    }

    public function behaviors()
    {
        return [
          'cms'=>[
              'class'=>CmsBehavior::className(),
          ],
            'translit'=>[
                'class'=>TranslitBehavior::className(),
            ]
        ];
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(),['primaryKey'=>'id'])->andWhere(['model'=>self::className()]);
    }

    public function getAnswerCount()
    {
        return $this->hasMany(Answer::className(),['forumId'=>'id'])->count();
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(),['id'=>'authorId']);
    }

    public function getPath()
    {
        return Url::to(['/forum/default/view','alias'=>$this->alias]);
    }

    public function beforeSave($insert)
    {
        $this->dateCreate = date(DATE_FORMAT_DB,strtotime($this->dateCreate));
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->dateCreate = Yii::$app->formatter->asDate(
            strtotime($this->dateCreate)
        );
    }

    public function getAnswerList()
    {
        return $this->hasMany(Answer::className(),['forumId'=>'id']);
    }
}
