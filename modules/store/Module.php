<?php

namespace app\modules\store;

use app\modules\store\components\Basket;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\store\controllers';

    public function init()
    {
        parent::init();
        $this->setComponents([
           'basket'=>[
               'class'=>Basket::className()
           ]
        ]);
        // custom initialization code goes here
    }
}
