<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 05.10.15
 * Time: 10:31
 */

namespace app\modules\exchange\controllers;


use app\modules\cms\models\CustomSeo;
use app\modules\cms\models\Reference;
use app\modules\exchange\models\City;
use app\modules\exchange\models\Contactor;
use app\modules\exchange\models\ContractorPrice;
use app\modules\exchange\models\ContractorSearch;
use app\modules\exchange\models\Tender;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;

class ContractorController extends Controller{

    /*public function actionIndex($specialization='')
    {
        if(!$specialization)
        {
            $specialization = 'specializacii';
        }

        $model = new Contactor();
        $model->load($_GET);
        Url::remember(\Yii::$app->request->url,'contractor');
        $specializationCategoryList = $model->getCategorySpecializationList();
        $itemPages = $model->getList($specialization);
        $contactorList = $itemPages['items'];
        $pages = $itemPages['pages'];

        if(sizeof($specializationCategoryList)>1)
        {
            $specialization = 'specializacii';
        }
        $specializationModel = Reference::findOne(['alias'=>$specialization]);
        if($specialization!='specializacii')
        {
            \Yii::$app->session->set('contractorSpec', $specializationModel);
        }
        return $this->render('index',['specializationModel'=>$specializationModel,'specialization'=>$specialization,'contactorList'=>$contactorList,'model'=>$model,'pages'=>$pages]);
    }*/

    public function actionIndex($path=null)
    {
        $model = new ContractorSearch();

        if(!$path)
        {
            throw new HttpException(404);
        }

        $referenceModel = new Reference();

        $pathArray = explode('/',$path);
        $city = array_pop($pathArray);

        $cityModel = City::find()->andWhere(['alias'=>$city])->one();
        if(!$cityModel){
            $cityModel = City::find()->andWhere(['alias' => 'ves-kazahstan'])->one();
            $city = null;
        }else{
            $path = implode('/',$pathArray);
        }

        $specializationModel = $referenceModel->findByFullPath($path);

        if (!$specializationModel) {
            throw new HttpException(404);
        }

        $seoModel = null;
        if($cityModel && $specializationModel)
        {
            $seoModel= CustomSeo::findOne(['cityId'=>$cityModel->id,'specializationId'=>$specializationModel->id]);
            if(!$seoModel)
                $seoModel = new CustomSeo();
        }else
            $seoModel = new CustomSeo();


        $params = [
            'specialization'    => $specializationModel,
            'city'              => $city,
        ];

        Url::remember(\Yii::$app->request->url,'contractor');

        $dataProvider = $model->search($params);
        return $this->render('index',[
            'model'=>$model,
            'specializationModel'=>$specializationModel,
            'dataProvider'=>$dataProvider,
            'specialization'=> $path,
            'cityModel'=>$cityModel,
            'seoModel'=>$seoModel,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $specializationModel = null;
        if($model->profile->load($_POST) && $model->profile->save(true,['memo']))
        {
            $this->redirect(['view','id'=>$id]);
        }
        $specializationModel = \Yii::$app->session->get('contractorSpec');
        $priceList = ContractorPrice::find()->where(['userId'=>$id])->priceOrder()->all();
        $workTenderList = $model->workTenderList;
        return $this->render('view',['model'=>$model,'priceList'=>$priceList,'specializationModel'=>$specializationModel,'workTenderList'=>$workTenderList]);
    }

    /**
     * @param $id
     * @return Contactor
     * @throws HttpException
     */
    protected function loadModel($id)
    {
        $model = Contactor::findOne($id);
        if(!$model)
        {
            throw new HttpException(404);
        }
        return $model;
    }

    public function actionUpdate($selected = 'price')
    {
        $id = \Yii::$app->user->id;
        $model = $this->loadModel($id);
        $model->scenario = 'descriptonSet';
        if($model->profile->load($_POST) && $model->profile->save(true,['memo']))
        {
            $this->redirect(['update','selected'=>'description']);
        }
        return $this->render('update',['model'=>$model,'selected'=>$selected]);
    }

    public function actionNotify($contractorId,$tenderId)
    {
        if(\Yii::$app->request->isAjax)
        {
            $tender = Tender::findOne($tenderId);
            if (!$tender) {
                throw new HttpException(404);
            }
            $contractor = Contactor::findOne($contractorId);
            if (!$tender) {
                throw new HttpException(404);
            }
            if($contractor->notify($tender))
            {
                return $this->renderPartial('notify',['tender'=>$tender,'contractor'=>$contractor]);
            }
        }

        throw new HttpException(403);
    }

    public function actionToinvite($contractorId,$tenderId)
    {
        if(\Yii::$app->request->isAjax)
        {
            $tender = Tender::findOne($tenderId);
            if (!$tender) {
                throw new HttpException(404);
            }
            $contractor = Contactor::findOne($contractorId);
            if (!$tender) {
                throw new HttpException(404);
            }
            if($contractor->toinvite($tender))
            {
                return $this->renderPartial('notify',['tender'=>$tender,'contractor'=>$contractor]);
            }
        }

        throw new HttpException(403);
    }
}
