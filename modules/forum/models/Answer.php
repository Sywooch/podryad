<?php

namespace app\modules\forum\models;

use Yii;

/**
 * This is the model class for table "iv_forum_answer".
 *
 * @property integer $id
 * @property integer $forumId
 * @property string $title
 * @property string $content
 * @property string $dateCreate
 * @property Item $forum
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iv_forum_answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forumId'], 'integer'],
            [['content'], 'string'],
            [['dateCreate'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['title','content'],'required'],
            [['forumId','title','content'],'required','on'=>'front.create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'forumId' => Yii::t('app', 'Forum ID'),
            'title' => Yii::t('app', 'Имя'),
            'content' => Yii::t('app', 'Текст'),
            'dateCreate' => Yii::t('app', 'Дата'),
        ];
    }

    public function getForum()
    {
        return $this->hasOne(Item::className(),['id'=>'forumId']);
    }

    public function beforeSave($insert)
    {
        $this->dateCreate = date(DATE_FORMAT_DB);
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->dateCreate = Yii::$app->formatter->asDate(
          strtotime($this->dateCreate)
        );
    }
}
