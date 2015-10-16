<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 17.08.15
 * Time: 13:20
 */

namespace app\modules\cms\controllers;


use app\modules\cms\models\form\PriceForm;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\web\Response;
use \Yii;

class PriceController extends Controller{

    public function actionIndex()
    {
        $model = new PriceForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load($_POST) && $model->send())
        {
            return $this->redirect(\Yii::$app->request->referrer);
        }
    }
}