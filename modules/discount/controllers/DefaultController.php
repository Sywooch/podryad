<?php

namespace app\modules\discount\controllers;


use app\modules\cms\models\Profile;
use app\modules\cms\models\User;
use app\modules\discount\models\Card;
use app\modules\discount\models\Category;
use app\modules\discount\models\History;
use app\modules\discount\models\Request;
use app\modules\discount\models\Service;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\web\UploadedFile;
use \Yii;

class DefaultController extends \yii\web\Controller
{
    public $layout = '@app/modules/discount/views/layouts/main';

    public function actionForm()
    {
        $model = new Card();
        $model->scenario = 'form';
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $this->redirect(['activate','cvcode'=>$model->cvcode]);
        }

        return $this->render('form',['model'=>$model]);
    }
    
    public function actionIndex()
    {
        $query = Service::find()->with(['image','category']);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>\Yii::$app->params['pageSize']]);
        $items = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id DESC')
            ->all();
        $this->layout = '//default';
        return $this->render('index',['items'=>$items,'pages'=>$pages]);
    }

    public function actionCategory($path)
    {
        $model = new Category();
        $category = $model->findByPath($path);
        if(!$category){
            throw new HttpException('404','Категория не найдена');
        }
        $this->layout = '//default';
        $items = $category->getItems(['pageSize'=>\Yii::$app->params['pageSize']]);

        $navigation = $category->parentId == 0 ? $category->children() : $category->getSiblings();

        return $this->render('category',[
            'items'=>$items,
            'model'=>$category,
            'navigation'=>$navigation,
        ]);
    }

    public function actionService($path)
    {
        $model = new Service();
        $service = $model->findByPath($path);
        if(!$service)
        {
            throw new HttpException('404','Страница услуги не найдена');
        }
        $this->layout = '//default';
        return $this->render('service',['model'=>$service]);
    }

    public function actionRequest($type)
    {
        $this->layout = '/default';
        $model = new Request();
        $model->type = $type;
        if($model->load($_POST) && $model->save())
        {
            $title = 'Новая заявка на получение карты на сайте: '.Yii::$app->name;
            Yii::$app->session->setFlash('success','Ваша заявка успешно создана.');
            $email = Yii::$app->params['email'];

            if(Yii::$app->mailer->compose('@app/modules/discount/views/default/mail/request',['model'=>$model,'title'=>$title])
            ->setFrom($email->from)
            ->setTo($email->to)
            ->setSubject($title)
            ->send()){
                $this->redirect(['/cms/default/success']);
            }            
        }else
        {
            return $this->render('request',['model'=>$model]);
        }
    }

    public function actionCard($cvcode)
    {
        /**
         * @var $model \app\modules\discount\models\Card
         */
        $model = Card::findByCvcode($cvcode);
        if(!$model)
        {
            throw new HttpException('404','Карта с таким кодом не найдена!');
        }

        if($model->isModerOrActivate() && \Yii::$app->user->isGuest)
        {
            Url::remember(['/discount/default/card','cvcode'=>$cvcode]);
            $this->redirect(['/site/login']);
        }
        
        $history = new History();
        return $this->render('card',['model'=>$model,'history'=>$history]);
    }

    public function actionActivate($cvcode)
    {
        /**
         * @var $model \app\modules\discount\models\Card
         */
        $model = Card::findByCvcode($cvcode);

        if(!$model)
        {
            throw new HttpException('404','Карта с таким кодом не найдена!');
        }

        $user = new User();
        $user->scenario = 'client.create';
        $user->role = 'client';
        $profile = new Profile();
        $profile->scenario = 'client.create';
        $partner = new \app\modules\cms\models\Partner;
        $partner->scenario = 'card.activate';
        $partner->load($_POST);
        
        $partnerValidate = $partner->email ? $partner->validate() : true;
//        var_dump($partnerValidate);
        if($user->load($_POST) && $profile->load($_POST) && $partnerValidate)
        {
            $model->status = Card::STATUS_ACTIVE;
            $user->dateCreate = date(DATE_FORMAT_DB);
            if($user->save())
            {
                $model->userId = $user->id;
                $profile->file = UploadedFile::getInstance($profile,'file');
                $profile->userId = $user->id;
                if($profile->file)
                {
                    $filename = $user->id.'.'.$profile->file->extension;
                    $filepath = \Yii::getAlias(Profile::PHOTO_DIR_ALIAS).'/'.$filename;
                    $profile->file->saveAs($filepath,false);
                    $profile->photo = $filename;
                }
                $profile->save();
                $model->dateActivate = date('Y-m-d H:i:s');
                $model->save(false,['status','userId','dateActivate']);
                
                if($partnerValidate)
                {
                    $partner->create($user);
                }
                
                $loginModel = new \app\models\LoginForm();
                $loginModel->username = $user->username;
                $loginModel->password = $user->password2;
                $loginModel->login();
     
                $this->redirect(['card','cvcode'=>$cvcode]);
            }
        }
        return $this->render('activate',['model'=>$model,'user'=>$user,'profile'=>$profile,'partner'=>$partner]);
    }


    public function actionUse()
    {
        $model = new History();
        if($model->load($_POST) && $model->save())
        {
            $this->redirect(Url::previous());
        }
    }

    public function actionSearch($q)
    {
        $this->layout = '//default';
        $model = new Service();
        $items = $model->search([
            'Service'=>[
                'title'=>$q
                ]
            ]
        );
        return $this->render('search',['items'=>$items,'q'=>$q]);
    }
}
