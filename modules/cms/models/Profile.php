<?php

namespace app\modules\cms\models;

use app\modules\cms\components\CmsBehavior;
use app\modules\exchange\models\Image as ExchangeImage;
use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $userId
 * @property integer $cityId
 * @property string $phone
 * @property string $familiya
 * @property string $imya
 * @property string $otchestvo
 * @property string $fio
 * @property string $company
 * @property string $site
 * @property string $adres
 * @property string $specializationsString
 * @property string $metaTitle
 * @property string $metaDescription
 * @property string $metaKeywords
 * @property Reference $city
 * @property Reference[] $specializations
 * @property Reference[] $cityList
 * @property array $specialization
 * @method string imageSrc(string $size = '100x100', string $method = Thumbler::METHOD_NOT_BOXED)
 */
class Profile extends \yii\db\ActiveRecord
{
    public $specialization;
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    public function getCityListString()
    {
        $data = [];
        foreach($this->cityList as $item)
        {
            $data[]=$item->title;
        }
        return implode(', ',$data);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cityId'], 'integer'],
            [['phone'], 'string', 'max' => 255],
            [['fio','company'], 'string', 'max' => 64],
            [['specialization','memo'],'safe'],
            ['file','file','skipOnEmpty'=>true],
            [['site','adres','metaDescription','metaKeywords','metaTitle'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => Yii::t('app', 'User ID'),
            'cityId' => Yii::t('app', 'Город'),
            'phone' => Yii::t('app', 'Телефон'),
            'fio'=> Yii::t('app', 'Ф.И.О'),
            'company'=> Yii::t('app', 'Компания'),
            'specialization' => Yii::t('app', 'Специализации'),
            'memo'=>Yii::t('app','Заметка'),
        ];
    }

    public function getSpecializations()
    {
        return $this->hasMany(Reference::className(), ['id' => 'specializationId'])
            ->viaTable('{{%user_specialization}}', ['userId' => 'userId']);
    }

    public function afterDelete()
    {
        Yii::$app->db->createCommand('DELETE FROM {{%user_specialization}} WHERE userId=' . $this->userId)->execute();
        return parent::afterDelete();
    }

    public function getCity()
    {
        return $this->hasOne(Reference::className(),['id'=>'cityId']);
    }

    public function getSpecializationsString()
    {
        $data = [];
        foreach($this->specializations as $v)
        {
            $data[]=$v->title;
        }
        return implode(', ', $data);
    }

    public function getImage()
    {
        return $this->hasOne(ExchangeImage::className(),['primaryKey'=>'userId'])
            ->andWhere(['model'=>self::className()]);
    }

    public function behaviors()
    {
        return [
          'cms'=>[
              'class'=>CmsBehavior::className(),
          ],
        ];
    }
}
