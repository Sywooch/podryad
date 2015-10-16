<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 14.08.15
 * Time: 12:15
 */

namespace app\modules\store\controllers;


use app\modules\store\models\Product;
use yii\web\Controller;
use yii\web\HttpException;

class ProductController extends Controller{

    public function actionView($category,$alias)
    {
        /** @var  $model Product */
        $model = Product::find()->where(['alias'=>$alias])->one();
        if(!$model || $model->category->alias != $category)
        {
            throw new HttpException(404,'Товар не найден');
        }
        return $this->render('view',['model'=>$model]);
    }

}