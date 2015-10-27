<?php

namespace app\modules\exchange\models;

use app\modules\cms\components\CmsBehavior;
use app\modules\cms\components\Shortext;
use app\modules\cms\models\Image;
use app\modules\cms\models\Reference;
use app\modules\cms\models\User;
use Yii;
use yii\data\Pagination;
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
 * @property $specializationsString string
 * @property Offers[] $offers
 * @usedBy app\modules\cms\components\CmsBehavior
 * @method string imageSrc(string $size = '100x100', string $method = Thumbler::METHOD_NOT_BOXED)
 */
class   Tender extends \yii\db\ActiveRecord
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

            [['title','description','phone','agree'],'required','on'=>'create'],
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
            ['specializationIds','safe'],
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
        return $this->price == 0 ? 'Договорный' : (int)($this->price) . ' тг';
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
            'active' => Yii::t('app', ''),
            'specializationId' => Yii::t('app', 'Специализация'),
            'file' => Yii::t('app', 'Файл'),
            'userId' => Yii::t('app', 'Айди пользователя'),
            'negotiable' => Yii::t('app', 'Бюджет договорный'),
            'dateCreate' => Yii::t('app', 'Дата'),
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
        return date('d.m.Y H:i');
    }

    public function behaviors()
    {
        return [
          'cms'=>[
              'class'=>CmsBehavior::className(),
          ],
            'short'=>[
                'class'=>Shortext::className(),
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
        $query = self::find()
            ->where(['userId'=>$id])
            ->orderBy(['dateCreate'=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount'=>$countQuery->count(),'pageSize'=>\Yii::$app->params['pageSize']]);

        return ['items'=>$query->offset($pages->offset)->limit($pages->limit)->all(),'pages'=>$pages];
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

    static $_statusList = [
        self::IS_NEW=> 'Новый',
        self::IS_OPEN=> 'Открыт',
        self::IS_ACTIVE=> 'Закрыт',
    ];

    public function getStatusTitle()
    {
        return !empty(self::$_statusList[$this->active]) ? self::$_statusList[$this->active] : 'не известно';
    }

    public static function statusDropdown()
    {
        return self::$_statusList;
    }

    public function getSpecializations()
    {
        return $this->hasMany(Reference::className(), ['id' => 'specializationId'])
            ->viaTable('{{%tender_specialization}}', ['tenderId' => 'id']);
    }

    public function getSpecializationsString()
    {
        $data = [];
        foreach ($this->specializations as $v) {
            $data[] = $v->title;
        }
        return implode(', ', $data);
    }

    public function getList()
    {
        $query = self::find()->joinWith(['user']);
        $query->open()->orderNew();

        foreach ($this->specializationIds as $specializationId) {
            $subQuery = TenderSpecialization::find()->select('tenderId')->where(['specializationId' => $specializationId]);
            $query->andWhere(['in', '{{%tender}}.id', $subQuery]);
        }

        if (!empty(\Yii::$app->request->cookies['city'])) {
            $params['cityId'] = \Yii::$app->request->cookies['city'];
            $query->joinWith(['user' => function ($query) use ($params) {
                return $query->join(['iv_user_profile.cityId' => $params['cityId']]);
            }]);
        }

        if ($this->priceMin && $this->priceMax) {
            $query->andWhere(['>=', 'price', (int)$this->priceMin]);
            $query->andWhere(['<=', 'price', (int)$this->priceMax]);
        }

        $pageCount = clone $query;
        $pages = new Pagination(['totalCount' => $pageCount->count(), 'pageSize' => \Yii::$app->params['pageSize']]);

        $items = $query->offset($pages->offset)->limit($pages->limit)->all();
        return ['items' => $items, 'pages' => $pages];
    }

    public function afterSave($insert, $changedAttribute)
    {
        if($this->specializationIds)
        {
            TenderSpecialization::deleteAll(['tenderId'=>$this->id]);
            foreach ($this->specializationIds as $specialiationId) {
                $model = Reference::findOne($specialiationId);
                $this->link('specializations', $model);
            }
        }
        return parent::afterSave($insert,$changedAttribute);
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
        $this->orderBy(['iv_tender.dateCreate'=>SORT_DESC]);
        return $this;
    }
}
