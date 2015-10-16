<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 17.08.15
 * Time: 12:23
 */

namespace app\modules\cms\controllers\admin;


use app\modules\cms\models\Price;
use \Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

class PriceController extends AdminController{

    public function actionIndex()
    {

        if(Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post('Price');
            $model = Price::findByObject($data['object'],$data['objectId']);
        }
        else
            $model = new Price();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load($_POST) && $model->save())
        {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

}