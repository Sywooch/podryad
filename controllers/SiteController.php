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

    public function actionTest()
    {
        $steps = 2;
        $lvl = 1;
        $maxLevel = 3;
        $currentSteps = pow($steps,$lvl);

        $data = [];
        for($i=1;$i<=$currentSteps;$i++)
        {
            $data[$lvl][$i]=$i;

            if($i == $currentSteps)
            {
                $i=0;
                $lvl++;
                $currentSteps = pow($steps,$lvl);
            }

            if($lvl-1==$maxLevel)
                break;
        }
        echo '<pre>';
        print_r($data);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(isset($_COOKIE['auth_tender']))
            {
                setcookie('auth_tender','',0);
                return $this->redirect(['/exchange/tender/create']);
            }
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
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
