<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 07.08.15
 * Time: 18:28
 */

namespace app\commands;


use app\modules\cms\models\User;
use yii\console\Controller;

class UserController extends Controller{

    public function actionEmail()
    {
        $items = User::find()->select('username')->all();
        foreach($items as $item)
        {
            file_put_contents('email-user.txt',$item->username."\r\n",FILE_APPEND);
        }
    }
}