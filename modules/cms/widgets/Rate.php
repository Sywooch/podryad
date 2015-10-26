<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 12.10.15
 * Time: 12:19
 */

namespace app\modules\cms\widgets;


use app\modules\cms\models\User;
use yii\bootstrap\Widget;

class Rate extends Widget{

    public $model;
    public $primaryKey;

    public function run()
    {
        if(\Yii::$app->user->can(User::ROLE_CONTRACTOR))
            return false;

        $inModel = $this->model;
        $modelList = \app\modules\cms\models\Rate::find()->ordered()->all();

        return $this->render('rate',['modelList'=>$modelList,'inModel'=>$inModel,'primaryKey'=>$this->primaryKey]);
    }

}