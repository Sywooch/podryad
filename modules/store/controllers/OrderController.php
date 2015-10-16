<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 05.08.15
 * Time: 17:26
 */

namespace app\modules\store\controllers;


use app\modules\store\models\Order;
use yii\web\Controller;
use \Yii;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class OrderController extends Controller{

    public function actionMake()
    {
        $model = new Order();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            $model->products = Yii::$app->request->post('OrderItem');
            $model->make();

            $subject = 'Заказ с сайта '.Yii::$app->name;
            Yii::$app->mailer->compose('order/make',['model'=>$model,'subject'=>$subject])
                ->setSubject($subject)
                ->setFrom(Yii::$app->params['email']->from)
                ->setTo($model->email)
                ->send();

            return $this->redirect(['view','key'=>$model->secretKey]);
        }
        $this->redirect(Yii::$app->request->referrer);
    }

    public function actionView($key)
    {
        $model = Order::findBySecretKey($key);
        if(!$model)
        {
            throw new HttpException('404','Заказ не найден');
        }
        return $this->render('view',['model'=>$model]);
    }

}