<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 02.10.15
 * Time: 10:41
 */

namespace app\modules\cms\widgets;


use app\modules\cms\models\User;
use yii\base\Widget;

class RegisterForm extends Widget{

    public function run()
    {
        if(\Yii::$app->user->isGuest == false)
            return true;
        $model = new \app\modules\cms\models\form\RegisterForm();
        $model->scenario = User::ROLE_CUSTOMER;
        $model->role = User::ROLE_CUSTOMER;
        return $this->render('registerForm',['model'=>$model]);
    }

}