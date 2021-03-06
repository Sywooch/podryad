<?php

namespace app\modules\cms\models;

use app\modules\cms\components\CmsBehavior;
use app\modules\exchange\models\Album;
use app\modules\exchange\models\Image as ExchangeImage;
use Yii;
use yii\helpers\ArrayHelper;

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
 * @property string $phone2
 * @property string $phone3
 * @property string $h1
 * @property Reference $city
 * @property Reference[] $specializations
 * @property Reference[] $cityList
 * @property array $specialization
 * @method string imageSrc($size = '100x100', $method = Thumbler::METHOD_NOT_BOXED)
 *
 * @property Album $albums
 * @property Image $albumImages
 */
class Profile extends \yii\db\ActiveRecord
{
    public $specialization;
    public $specializationList;
    public $cityList;
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    public static function cityDropdown()
    {
        $cityModel = \app\modules\cms\models\Reference::findOne(['alias' => 'cityList']);
        $cityList = \yii\helpers\ArrayHelper::map($cityModel->children(), 'id', 'title');
        return $cityList;
    }

    public function getCitySelected()
    {
        $data = [];
        foreach($this->cityLists as $city)
        {
            $data[$city->id]=$city->id;
        }
        return $data;
    }

    public function getCityListString($key='title')
    {
        $data = [];
        foreach($this->cityLists as $item)
        {
            $data[]=$item->$key;
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
            ['h1','string','max'=>128],
            [['specialization','memo','cityList', 'phone2', 'phone3','specializationList'],'safe'],
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
            'phone2' => Yii::t('app', 'Дополнительный телефон'),
            'phone3' => Yii::t('app', 'Дополнительный телефон'),
            'fio'=> Yii::t('app', 'Ф.И.О'),
            'company'=> Yii::t('app', 'Компания'),
            'specialization' => Yii::t('app', 'Специализации'),
            'memo'=>Yii::t('app','Описание'),
            'cityList'=>Yii::t('app','Города'),
            'file'=>Yii::t('app','Логотип'),
            'h1'=>Yii::t('app','H1'),
            'adres'=>Yii::t('app','Адрес'),
            'site'=>Yii::t('app','Сайт'),
            'specializationList'=>'Специализации',
        ];
    }

    public function getSpecializations()
    {
        return $this->hasMany(Reference::className(), ['id' => 'specializationId'])
            ->viaTable('{{%user_specialization}}', ['userId' => 'userId']);
    }

    public function getCityLists()
    {
        return $this->hasMany(Reference::className(), ['id' => 'cityId'])
            ->viaTable('{{%user_city}}', ['userId' => 'userId']);
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

    public function getImages()
    {
        return $this->hasMany(ExchangeImage::className(), ['primaryKey' => 'userId'])
            ->andWhere(['model' => self::className()]);
    }


    public function behaviors()
    {
        return [
          'cms'=>[
              'class'=>CmsBehavior::className(),
          ],
        ];
    }

    public function beforeSave($insert)
    {
        if(empty($this->h1))
        {

        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert,$changesAttributes)
    {
        if(sizeof($this->cityList)>0)
        {
            //города
            \Yii::$app->db->createCommand('DELETE FROM {{%user_city}} WHERE userId=' . $this->userId)->execute();
            foreach ($this->cityList as $cityId) {
                $model = Reference::findOne($cityId);
                $this->link('cityLists', $model);
            }
        }

        //специализации
        if ($this->specializationList) {
            Yii::$app->db->createCommand('DELETE FROM {{%user_specialization}} WHERE userId=' . $this->userId)->execute();
            foreach ($this->specializationList as $specialiationId) {
                $model = Reference::findOne($specialiationId);
                $this->link('specializations', $model);
            }
        }

        return parent::afterSave($insert,$changesAttributes);
    }

    public function specializationDropdown()
    {
        return ArrayHelper::map($this->specializations,'id','title');
    }

    public function getAlbums()
    {
        return $this->hasMany(Album::className(),['userId'=>'userId']);
        }

        public function getAlbumImages(){
            return $this->hasMany(Image::className(), ['primaryKey' => 'albums.id'])->andWhere(['model'=>Album::className()]);
        }
}
