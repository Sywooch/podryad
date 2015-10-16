<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 15.10.15
 * Time: 17:45
 */

namespace app\modules\exchange\controllers;


use app\modules\exchange\models\Reviews;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ReviewsController extends Controller{

    public function actionCreate()
    {
        $model = new Reviews();
        $model->scenario = 'create';
        if(\Yii::$app->request->isAjax && $model->load($_POST))
        {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if($model->load($_POST) && $model->save())
        {
            return $this->redirect(\Yii::$app->request->referrer);
        }
    }

}