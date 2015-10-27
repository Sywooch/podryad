<?php

namespace app\modules\exchange\models;

use app\modules\cms\models\User;
use Yii;

/**
 * This is the model class for table "{{%contractor_reviews}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $content
 * @property string $dateCreate
 * @property string $ratingCssClass
 * @property integer $rate
 * @property integer $contractorId
 * @property User $user
 * @property User $contractor
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contractor_reviews}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'rate', 'contractorId'], 'integer'],
            [['content'], 'string'],
            ['dateCreate','default','value'=>date(DATE_FORMAT_DB),'on'=>'create'],
            ['userId','default','value'=>\Yii::$app->user->id],
            [['content', 'contractorId'], 'required', 'on' => 'create'],
            ['content', 'string', 'min' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userId' => Yii::t('app', 'Заказчик'),
            'content' => Yii::t('app', 'Текст'),
            'rate' => Yii::t('app', 'Like Dislike'),
            'contractorId' => Yii::t('app', 'Подрядчик'),
            'dateCreate' => Yii::t('app', 'Дата и время'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'userId']);
    }

    public function getContractor()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getRatingCssClass()
    {
        return $this->rate == 0 ? 'dislike' : 'like';
    }

    public function getDate()
    {
        return date('d.m.Y H:i', strtotime($this->dateCreate));
    }
}
