<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 22.09.15
 * Time: 11:01
 */

namespace app\modules\cms\controllers;


use app\modules\cms\models\File;
use yii\web\Controller;
use yii\web\HttpException;

class FileController extends Controller{

    public function actionIndex()
    {
        $modelList = File::find()->all();
        return $this->render('index',['modelList'=>$modelList]);
    }

    public function actionDownload($id)
    {
        $file = File::findOne($id);
        if(!$file)
        {
            throw new HttpException(404,'Файл не найден!');
        }
        $file->download();
    }

}