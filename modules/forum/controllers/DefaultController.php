<?php

namespace app\modules\forum\controllers;

use app\modules\cms\controllers\MainController;
use app\modules\cms\models\Image;
use app\modules\forum\models\Answer;
use app\modules\forum\models\Item;
use yii\helpers\Html;
use yii\web\HttpException;
use yii\web\UploadedFile;

class DefaultController extends MainController
{
    public function actionIndex()
    {
        $forumList = Item::find()->orderBy(['dateCreate'=>SORT_DESC])->all();
        return $this->render('index',['forumList'=>$forumList]);
    }

    public function actionCreate()
    {
        $model = new Item();
        $model->scenario = 'front.create';
        $model->authorId = \Yii::$app->user->id;
        if($model->load($_POST))
        {
            $model->photo = UploadedFile::getInstance($model,'photo');
            if($model->save())
            {
                $image = new Image();
                $image->file = $model->photo;
                $image->model = Item::className();
                $image->primaryKey = $model->id;
                $image->create();
                return $this->redirect(['view', 'alias' => $model->alias]);
            }else
            {
                echo Html::errorSummary($model);
            }
        }

        return $this->render('create',['model'=>$model]);
    }

    public function actionView($alias)
    {
        $model = Item::find()->with(['answerList'])->where(['alias'=>$alias])->one();
        if(!$model)
        {
            throw new HttpException('404','Вопрос не найден');
        }
        $answerModel = new Answer();
        $answerModel->scenario = 'front.create';
        $answerModel->forumId = $model->id;
        if($answerModel->load($_POST) && $answerModel->save())
        {
            return $this->redirect(['view','alias'=>$alias]);
        }
        return $this->render('view',['model'=>$model,'answerModel'=>$answerModel]);
    }
}
