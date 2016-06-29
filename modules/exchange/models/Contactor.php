<?php

namespace app\modules\exchange\models;


use app\modules\cms\models\Image as ContractorImage;
use app\modules\cms\models\Reference;
use app\modules\cms\models\Settings;
use app\modules\cms\models\User;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 05.10.15
 * Time: 11:40
 *
 * @property \app\modules\exchange\models\Tender[] $workTenderList
 * @property $title string
 * @property $photoCount integer
 *
 */
class Contactor extends User
{

    public $specializationIds = [];

    public function rules()
    {
        return [
            ['specializationIds', 'safe'],
        ];
    }

    public function getCategorySpecializationList()
    {
        $parents = [];

        if ($this->specializationIds) {

            foreach ($this->specializationIds as $specializationId) {

                $reference = Reference::findOne($specializationId);
                if ($reference) {
                    $parentList = $reference->parents();
                    if (!empty($parentList[1])) {
                        $parents[$parentList[1]->alias] = $parentList[1]->alias;
                    }
                }
            }
        }

        return $parents;
    }

    public function getList($specialization)
    {
        $query = self::find()->innerJoinWith(['assignment'])->with(['profile'=>function ($query)
        {
            $query->with(['specializations', 'cityLists', 'city', 'image']);
        }]);
        $query->where(['item_name' => User::ROLE_CONTRACTOR]);


        if ($this->specializationIds) {
            foreach ($this->specializationIds as $specializationId) {
                $subQuery = UserSpecialization::find()->select('userId')->where(['specializationId' => $specializationId]);
                $query->andWhere(['in', 'id', $subQuery]);
            }
        } else {
            $specializationModel = Reference::findOne(['alias' => $specialization]);
            $specializationIds = [];
            foreach ($specializationModel->childrens() as $child) {
                $specializationIds[] = $child->id;
            }
            $subQuery = UserSpecialization::find()->select('userId')->where(['in', 'specializationId', $specializationIds]);
            $query->andWhere(['in', 'id', $subQuery]);
        }

        if (!empty(\Yii::$app->request->cookies['city'])) {
            $params['cityId'] = \Yii::$app->request->cookies['city'];
            $query->joinWith(['profile' => function ($query) use ($params) {
                $subQuery = UserCity::find()->select('userId')->where(['cityId'=>$params['cityId']]);
                return $query->where(['in','{{%user_profile}}.userId',$subQuery]);
            }]);
        }

        $pageCount = clone $query;
        $pages = new Pagination(['totalCount'=> $pageCount->count(),'pageSize'=>\Yii::$app->params['pageSize']]);

        //сортировка раз в сутки
        $orderSettingsData = Settings::get('exchange','contractorOrder',true);
        $contractorSort = [];
        $currentDate = date('d.m.Y');
        if($orderSettingsData)
        {
           if(substr_count($orderSettingsData,'@'))
           {
               list($dateOrder, $allUserIdList) = explode('@',$orderSettingsData);
               if($dateOrder != $currentDate)
               {
                   $allUserIdList = $this->getRandomIds();
                   Settings::set('exchange', 'contractorOrder', $currentDate . '@' . $allUserIdList, true);
               }
           }
        }
        else{
            $allUserIdList = $this->getRandomIds();
            Settings::set('exchange','contractorOrder',$currentDate.'@'.$allUserIdList,true);
        }
        $contractorSort = new \yii\db\Expression('FIND_IN_SET(iv_user.id,:userList)');
        $query->addParams([':userList' => $allUserIdList]);
//        $items = $query->offset($pages->offset)->limit($pages->limit)->orderBy([$contractorSort])->all();
        $items = $query->orderBy([$contractorSort])->all();
        return ['items'=>$items,'pages'=>$pages];
    }

    private function getRandomIds()
    {
        $orderIdsList = ArrayHelper::map(Contactor::find()->orderBy('rand()'),'id','id');
        return implode(',', $orderIdsList);
    }

    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['id' => 'userId']);
    }

    public function isMine()
    {
        if (\Yii::$app->user->isGuest)
            return false;
        return \Yii::$app->user->id == $this->id;
    }

    public function getWorkTenderList()
    {
        return $this->hasMany(Tender::className(), ['contractorId' => 'id']);
    }

    public function getPhotoCount()
    {
        $albumIds = ArrayHelper::map($this->profile->albums,'id','id');

        if(empty($albumIds))
            return 0;

        return ContractorImage::find()->where(['primaryKey' => $albumIds, 'model' => Album::className()])->count();
    }

    public function notify($tender)
    {
        $params = \Yii::$app->params;
        $subject = $params['subjects']['contractor.notify'];
        return \Yii::$app->mailer->compose('contractor/notify',['tender'=>$tender,'subject'=>$subject])
            ->setSubject($subject)
            ->setFrom($params['email']->from)
            ->setTo($this->username)
            ->send();
    }

    public function toinvite($tender)
    {
        $params = \Yii::$app->params;
        $subject = $params['subjects']['contractor.notify'];
        return \Yii::$app->mailer->compose('contractor/toinvite',['tender'=>$tender,'subject'=>$subject])
            ->setSubject($subject)
            ->setFrom($params['email']->from)
            ->setTo($this->username)
            ->send();
    }

    public function getTitle($h1=false)
    {
      if($h1 && !empty($this->profile->h1))
      {
          return $this->profile->h1;
      }

	  if(!empty($this->profile->company)){
		  return $this->profile->company;
	  }else{
		  return $this->profile->fio;
	  }  
	  //  return $this->profile->fio;
    }
}
