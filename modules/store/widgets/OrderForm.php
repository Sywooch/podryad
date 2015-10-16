<?php
namespace app\modules\store\widgets;

class OrderForm extends \yii\base\Widget{

    public function run()
    {
        $model = new \app\modules\store\models\Order();
        return $this->render('orderFormView',['model'=>$model]);
    }

}