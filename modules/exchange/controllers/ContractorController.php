<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 05.10.15
 * Time: 10:31
 */

namespace app\modules\exchange\controllers;


use app\modules\exchange\models\Contactor;
use app\modules\exchange\models\ContractorPrice;
use app\modules\exchange\models\Tender;
use yii\web\Controller;
use yii\web\HttpException;

class ContractorController extends Controller{

    public function actionIndex($specialization='')
    {
        if(!$specialization)
        {
            $specialization = 'specializacii';
        }

        $model = new Contactor();
        $model->load($_GET);
        $specializationCategoryList = $model->getCategorySpecializationList();
        $itemPages = $model->getList($specialization);
        $contactorList = $itemPages['items'];
        $pages = $itemPages['pages'];

        if(sizeof($specializationCategoryList)>1)
        {
            $specialization = 'specializacii';
        }

        return $this->render('index',['specialization'=>$specialization,'contactorList'=>$contactorList,'model'=>$model,'pages'=>$pages]);
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);
        if($model->profile->load($_POST) && $model->profile->save(true,['memo']))
        {
            $this->redirect(['view','id'=>$id]);
        }
        $priceList = ContractorPrice::find()->where(['userId'=>$id])->priceOrder()->all();
        $workTenderList = $model->workTenderList;
        return $this->render('view',['model'=>$model,'priceList'=>$priceList,'workTenderList'=>$workTenderList]);
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
}