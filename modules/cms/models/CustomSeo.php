<?php

namespace app\modules\cms\models;

use Yii;

/**
 * This is the model class for table "{{%custom_seo}}".
 *
 * @property integer $id
 * @property integer $specializationId
 * @property integer $cityId
 * @property string $h1
 * @property string $title
 * @property string $metaKeywords
 * @property string $metaDescription
 * @property string $seoText
 *
 * @property Reference $city
 * @property Reference $specialization
 */
class CustomSeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%custom_seo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['specializationId', 'cityId'], 'integer'],
            [['h1', 'title', 'metaKeywords'], 'string', 'max' => 255],
            [['metaDescription'], 'string', 'max' => 300],
            ['seoText','safe'],
            [['specializationId','cityId','title'],'required'],
            [['specializationId','cityId'],'unique','targetAttribute'=>['specializationId','cityId'],'message'=>'Данная связка уже есть'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'specializationId' => 'Специализация',
            'cityId' => 'Город',
            'h1' => 'H1',
            'title' => 'Title',
            'metaKeywords' => 'Meta Keywords',
            'metaDescription' => 'Meta Description',
            'seoText' => 'СЕО текст',
        ];
    }

    public function getCity()
    {
        return $this->hasOne(Reference::className(),['id'=>'cityId']);
    }

    public function getSpecialization()
    {
        return $this->hasOne(Reference::className(), ['id' => 'specializationId']);
    }
}
