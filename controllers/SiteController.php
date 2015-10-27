<?php

namespace app\controllers;

use app\modules\cms\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Cookie;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            if (\Yii::$app->user->can(User::ROLE_CONTRACTOR))
            {
                return $this->redirect(['/exchange/contractor/view','id'=>\Yii::$app->user->id]);
            }

            if(isset(\Yii::$app->request->cookies['customer']))
            {
                $cookies = \Yii::$app->response->cookies;
                $cookies->remove('customer');
                return $this->redirect(['/exchange/tender/create']);
            }


            if(substr_count(\Yii::$app->request->referrer,'site/login'))
                return $this->goBack();

            return $this->redirect(\Yii::$app->request->referrer);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionCookie($name)
    {
        \Yii::$app->response->cookies->add(new Cookie([
            'name'=>$name,
            'value'=>true,
        ]));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;

//        if(!Yii::$app->user->isGuest && \Yii::$app->user->identity->role == '')
//            $this->redirect(['/cms/default/pending']);

        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

}
