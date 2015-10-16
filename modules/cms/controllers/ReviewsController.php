<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 21.07.15
 * Time: 16:38
 */

namespace app\modules\cms\controllers;


use app\modules\cms\models\Reviews;
use yii\web\Controller;

class ReviewsController extends Controller{

    public function actionIndex()
    {

        $model = new Reviews();
        $model->scenario = 'site.create';
        if($model->load($_POST) && $model->save())
        {
            $this->redirect(['index']);
        }
        $items = Reviews::find()->visible()->orderBy('dateCreate DESC')->all();
        return $this->render('index',['items'=>$items,'model'=>$model]);
    }

}