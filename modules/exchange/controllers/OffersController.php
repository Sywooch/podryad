<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 03.10.15
 * Time: 11:37
 */

namespace app\modules\exchange\controllers;


use app\modules\cms\models\User;
use app\modules\exchange\models\Offers;
use app\modules\exchange\models\Tender;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class OffersController extends Controller{

    public function behaviors()
    {
        return [
          'access'=>[
              'class'=>AccessControl::className(),
              'rules'=>[
                  [
                      'allow'=>true,
                      'roles'=>[User::ROLE_CONTRACTOR],
                      'actions'=>['create','validate-create'],
                  ],
                  [
                      'allow'=>true,
                      'actions'=>['rate-set','contractor-set'],
                      'roles'=>[User::ROLE_CUSTOMER],
                  ]
              ],
          ]
        ];
    }

    public function actionCreate($tenderId)
    {
        $model = new Offers();
        $model->scenario = 'new';
        $model->tenderId = $tenderId;
        $model->userId = \Yii::$app->user->id;
        if($model->load($_POST))
        {
            $model->save();
            $subject = 'Поступило новое предложение с сайта '.APP_NAME;
            \Yii::$app->mailer->compose('offers/create',['model'=>$model,'subject'=>$subject])
                ->setSubject($subject)
                ->setFrom(\Yii::$app->params['email']->from)
                ->setTo($model->tender->user->username)
                ->send();
            \Yii::$app->session->setFlash('success','Ваше предложение успешно добавленно!');
        }
        return $this->redirect(['/exchange/tender/view', 'id' => $tenderId]);
    }

    public function actionValidateCreate()
    {
        $model = new Offers();
        $model->scenario = 'new';
        if(\Yii::$app->request->isAjax && $model->load($_POST))
        {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionRateSet($id,$rate)
    {
        $model = $this->loadModel($id);
        $model->rateSet($rate);
        return $this->redirect(['/exchange/tender/view', 'id' => $model->tenderId]);
    }


    public function actionContractorSet($id)
    {
        $model = $this->loadModel($id);
        $model->tender->contractorSet($model);
        $subject= 'Вас пригласили для участия в тендере на сайте' . APP_NAME;
        \Yii::$app->mailer->compose('contractor/notify',['model'=>$model->tender,'subject'=>$subject])
            ->setSubject($subject)
            ->setFrom(\Yii::$app->params['email']->from)
            ->setTo($model->user->username)
            ->send();
        $this->redirect(['/exchange/tender/view','id'=>$model->tenderId]);
    }

    /**
     * @param $id
     * @return Offers
     * @throws HttpException
     */
    protected function loadModel($id)
    {
        $model = Offers::findOne($id);
        if(!$model)
        {
            throw new HttpException(404);
        }
        return $model;
    }
}