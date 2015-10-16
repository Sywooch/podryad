<?php

namespace app\modules\exchange\models;

use app\modules\cms\components\CmsBehavior;
use app\modules\cms\models\Image;
use app\modules\cms\models\Reference;
use app\modules\cms\models\User;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%tender}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $phone
 * @property string $price
 * @property string $priceString
 * @property integer $active
 * @property Image $image
 * @property Reference $specialization
 * @property $userId integer
 * @property $dateCreate string
 * @property $date string
 * @property $statusTitle string
 * @property $url string
 * @property $specializationTitle string
 * @property $offersListId array
 * @property $contractorId integer
 * @property $offersId integer
 * @property User $user
 * @property Offers[] $offers
 * @usedBy app\modules\cms\components\CmsBehavior
 * @method string imageSrc(string $size = '100x100', string $method = Thumbler::METHOD_NOT_BOXED)
 */
class Tender extends \yii\db\ActiveRecord
{

    public $agree;
    public $file;
    public $specializationIds = [];
    public $priceMin=0;
    public $priceMax=0;
    public $negotiable;

    const IS_ACTIVE = 1;
    const IS_OPEN = 0;
    const IS_NEW = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tender}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['active'], 'integer'],
            [['title'], 'string', 'max' => 300],
            [['phone'], 'string', 'max' => 32],
            [['priceMin','priceMax'],'number'],
            [['title','description'],'required','on'=>'new'],

            [['title','description','specializationId','phone','agree'],'required','on'=>'create'],
            ['file','file','on'=>'create','skipOnEmpty'=>true],
            ['agree', 'required', 'message' => 'Вы должны принять условия!', 'isEmpty' => function ($value) {
                return $value == 0;
            },'on'=>'create'],
            ['price','number','numberPattern'=>'#^(\d+\.\d+)|(\d+)$#','on'=>'create'],
            ['active','default','value'=>self::IS_OPEN,'on'=>'create'],
            ['active','default','value'=>self::IS_NEW,'on'=>'new'],
            ['dateCreate','default','value'=>date(DATE_FORMAT_DB)],
            ['userId','default','value'=>\Yii::$app->user->id],
//            ['specizalizationIds','each','rule'=>['integer'],'on'=>'filter'],
            [['priceMin','priceMax','specializationIds'],'safe','on'=>'filter'],
            ['price','number','on'=>'filter'],
            ['negotiable','checkNegotiable'],
        ];
    }

    public function checkNegotiable()
    {
        if(empty($this->price) && $this->negotiable != '1')
        {
            $this->addError('price','Вы должны указать либо цену, либо проставить галочку на договорная');
        }elseif($this->price>0 && $this->negotiable == '1')
        {
            $this->price = 0;
        }
    }

    public function getPriceString()
    {
        return $this->price == 0 ? 'Договорный' : $this->price . 'тг';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание работы'),
            'phone' => Yii::t('app', 'Телефон'),
            'price' => Yii::t('app', 'Бюджет проекта'),
            'active' => Yii::t('app', 'Active'),
            'specializationId' => Yii::t('app', 'Специализация'),
            'file' => Yii::t('app', 'Файл'),
            'userId' => Yii::t('app', 'Айди пользователя'),
            'negotiable' => Yii::t('app', 'Бюджет договорный'),
        ];
    }

    public static function find()
    {
        return new TenderQuery(get_called_class());
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(),['primaryKey'=>'id'])
            ->andWhere(['model'=>self::className()]);
    }

    public function getSpecialization()
    {
        return $this->hasOne(Reference::className(),['id'=>'specializationId']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'userId']);
    }

    public function getDate()
    {
        return \Yii::$app->formatter->asDatetime(strtotime($this->dateCreate));
    }

    public function behaviors()
    {
        return [
          'cms'=>[
              'class'=>CmsBehavior::className(),
          ]
        ];
    }

    public function getUrl()
    {
        return Url::to(['/exchange/tender/view','id'=>$this->id]);
    }

    public function getOffers()
    {
        return $this->hasMany(Offers::className(),['tenderId'=>'id']);
    }

    public function getOffersCount()
    {
        return $this->hasMany(Offers::className(), ['tenderId' => 'id'])->count();
    }


    public function getOffersListId()
    {
        $data = [];
        foreach($this->offers as $offer)
        {
            $data[]=$offer->userId;
        }
        return $data;
    }

    public function getSpecializationTitle(){
        $data[] = $this->specialization ? $this->specialization->parent->title : null;
        $data[] = $this->specialization->title;
        return implode(' - ',$data);
    }

    public function getMinMaxPrice()
    {
        $result = \Yii::$app->db->createCommand('SELECT min(price) as min,max(price) as max FROM '.self::tableName())->queryOne();
        return $result ? $result : ['min'=>0,'max'=>0];
    }

    /**
     * @param $id
     * @return Tender[]
     */
    public static function getTenderByUser($id)
    {
        return self::find()
            ->where(['userId'=>$id])
            ->all();
    }

    /**
     * @param $offers Offers
     */
    public function contractorSet($offers)
    {
        $this->active = self::IS_ACTIVE;
        $this->contractorId = $offers->userId;
        $this->offersId = $offers->id;
        $this->save(false,['contractorId','offersId','active']);
    }

    public function isMine()
    {
       return $this->userId == \Yii::$app->user->id;
    }

    public function isOpen()
    {
        return $this->active == self::IS_OPEN;
    }

    public function cssSelected($offersId)
    {
        return $this->offersId == $offersId ? 'selected' : '';
    }

    public function getStatusTitle()
    {
        $status = '';
        if($this->active == self::IS_NEW)
        {
            $status = 'Новый';
        }
        elseif($this->active == self::IS_OPEN)
        {
            $status = 'Открыт';
        } elseif ($this->active == self::IS_ACTIVE) {
            $status = 'Закрыт';
        }
        return $status;
    }
}

class TenderQuery extends ActiveQuery
{
    public function open()
    {
        $this->andWhere(['active'=>Tender::IS_OPEN]);
        return $this;
    }

    public function active()
    {
        $this->andWhere(['active' => Tender::IS_ACTIVE]);
        return $this;
    }

    public function orderNew()
    {
        $this->orderBy(['dateCreate'=>SORT_DESC]);
        return $this;
    }
}
