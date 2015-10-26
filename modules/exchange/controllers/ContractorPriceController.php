<?php

namespace app\modules\exchange\controllers;

use app\modules\exchange\models\ContractorPrice;
use yii\web\HttpException;

class ContractorPriceController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $model = new ContractorPrice();
        $model->userId = \Yii::$app->user->id;
        if($model->load($_POST) && $model->save())
        {
            \Yii::$app->session->setFlash('success','Услуга успешно добавлена!');
            return $this->redirect(['update','id'=>$model->id]);
        }
        return $this->render('create',['model'=>$model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if ($model->load($_POST) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Услуга успешно обновлена!');
            return $this->redirect(['update', 'id' => $model->id]);
        }
        return $this->render('update',['model'=>$model]);
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        if($model->user->isMine())
            $model->delete();

        $this->redirect(['/exchange/contractor/view', 'id' => $model->userId]);
    }

    /**
     * @param $id
     * @return ContractorPrice
     * @throws HttpException
     */
    protected function loadModel($id)
    {
        $model = ContractorPrice::findOne($id);
        if(!$model)
        {
            throw new HttpException('404');
        }
        return $model;
    }

}
