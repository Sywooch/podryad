<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 28.07.15
 * Time: 15:45
 */

namespace app\modules\store\controllers;


use yii\web\Controller;
use \Yii;
use app\modules\store\models\Product;
use yii\web\HttpException;

class BasketController extends Controller{

    public function actionAdd()
    {
        $productId = Yii::$app->request->post('productId');
        $product = $this->loadProduct($productId);
        $quantity = Yii::$app->request->post('quantity');
        $quantity = $quantity <= 0 ? 1 : $quantity;
        $this->module->basket->add($product,$quantity);
        $this->redirect(Yii::$app->request->referrer);
    }

    public function actionRemove($productId)
    {
        $product = $this->loadProduct($productId);
        $this->module->basket->remove($productId);
        $this->redirect(Yii::$app->request->referrer);
    }

    protected function loadProduct($productId)
    {
        $product = Product::findOne($productId);
        if(!$product)
        {
            throw new HttpException(404,'Товар не найден');
        }
        return $product;
    }

}