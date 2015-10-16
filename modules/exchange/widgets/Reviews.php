<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 15.10.15
 * Time: 17:50
 */

namespace app\modules\exchange\widgets;


use yii\base\Widget;

class Reviews extends Widget
{
    public $contractorId;
    public function run()
    {
        $reviewsList = \app\modules\exchange\models\Reviews::findAll(['contractorId'=>$this->contractorId]);
        $model = new \app\modules\exchange\models\Reviews();
        $model->contractorId = $this->contractorId;
        return $this->render('reviews',['reviewsList'=>$reviewsList,'model'=>$model]);
    }
}