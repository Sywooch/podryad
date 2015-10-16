<?php

namespace app\modules\cms\controllers;

use app\modules\cms\models\form\Feedback;
use yii\web\Controller;
use yii\web\HttpException;
use app\modules\cms\models\Page;
use yii\widgets\ActiveForm;
use yii\web\Response;
use \Yii;
use yii\helpers\Url;

class DefaultController extends Controller
{
    public function actionPending()
    {
        return $this->render('pending');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSuccess()
    {
        $this->layout = '/default';
        $message = \Yii::$app->session->getFlash('success');
        return $this->render('success',['message'=>$message]);
    }

    public function actionPage($path='index')
    {
        /** @var  $page  Page*/
        $model = new Page();
        $page = $model->findByFullPath($path);
        if(!$page)
        {
            throw new HttpException('404','Страница не найдена');
        }
//        $page->imageThemeSet();
        return $this->render('page',['page'=>$page]);
    }

    public function actionFeedback()
    {
        $model = new Feedback();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load($_POST) && $model->validate())
        {
            $model->send();
            Yii::$app->controller->redirect(Url::home());
        }
    }

    public function actionTour()
    {
        return $this->render('3dtour');
    }

    public function actionGallery()
    {
        $model = Page::findOne(['alias'=>'gallery']);
        if(!$model){
            throw new \HttpException('404','Альбом не найден');
        }
        $items = $model->images;
        return $this->render('gallery',['items'=>$items]);
    }

    public function actionContact()
    {
        return $this->render('contact');
    }
}
