<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 21.09.15
 * Time: 10:22
 */

namespace app\modules\cms\controllers;


use app\modules\cms\models\form\RegisterForm;
use app\modules\cms\models\form\RemindUser;
use app\modules\cms\models\form\RestoreUser;
use app\modules\cms\models\Image;
use app\modules\cms\models\Profile;
use app\modules\cms\models\User;
use app\modules\exchange\models\Tender;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class UsersController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['view','update'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['register','register-validate','remind','restore'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionRegister($scenario)
    {
        $model = new RegisterForm();
        $model->scenario = $scenario;
        $model->role = $scenario;

        if ($model->load($_POST) && $model->validate()) {
            if ($model->register()) {
                return $this->redirect($model->role == User::ROLE_CUSTOMER ? ['view', 'id' => $model->id] : ['/exchange/contractor/view','id'=>$model->id]);
            }
        }
        return $this->render('register', ['model' => $model]);
    }

    public function actionRegisterValidate($scenario)
    {
        $model = new RegisterForm();
        $model->scenario = $scenario;
        $model->role = $scenario;
        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionUpdate()
    {
        $id = \Yii::$app->user->id;
        $user = $this->loadUser($id);
        $profile = $user->profile;

        $model = new RegisterForm();
        $model->scenario = 'update';

        if($model->load($_POST) && $model->validate())
        {
            if($model->update($user,$profile))
            {
                \Yii::$app->session->setFlash('success','Ваши данные успешно обновленны!');
                return $this->redirect(['update']);
            }
        }

        $model->role = $user->role;
        foreach($model->attributes as $k=>$v)
        {
            if($user->hasAttribute($k))
            {
                $model->$k = $user->$k;
            }
            if ($profile->hasAttribute($k)) {
                $model->$k = $profile->$k;
            }
        }
        return $this->render('update', ['model' => $model,'profile'=>$user->profile]);
    }

    public function actionView()
    {
        $id = \Yii::$app->user->id;
        $model = $this->loadUser($id);
        $profile = $model->profile;
        if($profile->load($_POST))
        {
            $profile->file = UploadedFile::getInstance($profile,'file');
            if($profile->file)
            {

                if($profile->image)
                {
                    $profile->image->delete();
                }

                $image = new Image();
                $image->model = $profile::className();
                $image->primaryKey = $profile->userId;
                $image->file = $profile->file;
                $image->create();
                $this->redirect(['view','id'=>$id]);
            }
        }
        $tender = new Tender();
        return $this->render('view',['model'=>$model,'tender'=>$tender]);
    }

    /**
     * @param $id
     * @return User
     * @throws HttpException
     */
    private function loadUser($id)
    {
        $model = User::findOne($id);
        if(!$model)
        {
            throw new HttpException(404);
        }
//        $model->scenario = 'update';
//        $model->profile->scenario = 'update';
        return $model;
    }

    public function actionRemind()
    {
        $model = new RemindUser();
        if($model->load($_POST) && $model->validate() && $model->send())
        {
            \Yii::$app->session->setFlash('success','На вашу почту было выслано письмо с подробными инструкциями.');
            return $this->redirect(['/']);
        }
        return $this->render('remind',['model'=>$model]);
    }

    public function actionRestore($key)
    {
        $user = User::findOne(['password_reset_token'=>$key]);
        if(!$user)
        {
            throw new HttpException('404','Запись не найдена');
        }
        $model = new RestoreUser();
        $model->user = $user;
        if($model->load($_POST) && $model->validate() && $model->change())
        {
            \Yii::$app->session->setFlash('success','Вы успешно изменили пароль!');
            return $this->redirect(['/']);
        }
        return $this->render('restore',['model'=>$model]);
    }
}