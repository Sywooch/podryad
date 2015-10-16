<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 12.10.15
 * Time: 15:17
 */

namespace app\modules\cms\controllers;


use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;

class RateController extends Controller{

    public function actionIndex()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new \app\modules\cms\models\Rate();
        $model->scenario = 'rate';

        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->rate();
            return ['message' => 'Вы успешно проголосовали','count'=>$model->getTotalRate($model->model,$model->primaryKey)];
        }
        else
        {
            return ['error'=>Html::error($model,'id')];
        }


    }

}