<?php

namespace app\modules\cms\models;

use app\modules\directorBoard\models\Board;
use Yii;

/**
 * This is the model class for table "{{%page_doctor}}".
 *
 * @property integer $id
 * @property integer $pageId
 * @property integer $doctorId
 * @property Board $doctor
 */
class PageDoctor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_doctor}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pageId', 'doctorId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pageId' => Yii::t('app', 'Страница'),
            'doctorId' => Yii::t('app', 'Доктор'),
        ];
    }

    public function getDoctor()
    {
        return $this->hasOne(Board::className(),['id'=>'doctorId']);
    }

    public function getDoctorList()
    {
        return $this->hasOne(Board::className(), ['doctorId' => 'id']);
    }
}
