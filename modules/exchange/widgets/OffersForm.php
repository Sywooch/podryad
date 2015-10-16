<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 03.10.15
 * Time: 11:42
 */

namespace app\modules\exchange\widgets;


use app\modules\exchange\models\Offers;
use yii\base\Widget;

class OffersForm extends Widget {

    public $tenderId;

    public function run()
    {
        $model = new Offers();
        $model->scenario = 'new';
        return $this->render('offersForm',['model'=>$model,'tenderId'=>$this->tenderId]);
    }

}