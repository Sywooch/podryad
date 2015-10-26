<?php

namespace app\modules\exchange\controllers;

use app\modules\cms\models\User;
use app\modules\exchange\models\Album;
use yii\filters\AccessControl;
use yii\web\HttpException;

class AlbumController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
          'access'=>[
              'class'=>AccessControl::className(),
              'rules'=>[
                  [
                      'allow'=>true,
                      'roles'=>[User::ROLE_CONTRACTOR],
                  ]
              ]
          ],
        ];
    }

    public function actionCreate()
    {
        $model = new Album();
        $model->userId = \Yii::$app->user->id;
        if($model->load($_POST) && $model->save())
        {
            return $this->redirect(['update','id'=>$model->id]);
        }
        return $this->render('create',['model'=>$model]);
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $model->delete();
        return $this->redirect(['/exchange/contractor/view','id'=>$model->userId]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        return $this->render('update',['model'=>$model]);
    }

    /**
     * @param $id
     * @return Album
     * @throws HttpException
     */
    protected function loadModel($id)
    {
        $model = Album::findOne($id);
        if(!$model)
        {
            throw new HttpException(404);
        }
        return $model;
    }
}
