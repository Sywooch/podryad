<?php

namespace app\components;

use Yii;

class Redirect
{

    public static function scan()
    {
        $data = [
            '/exchange/contractor?specialization=remont-i-otdelka'=>'/exchange/contractor/remont-i-otdelka',
            '/exchange/contractor?specialization=stroitelstvo'=>'/exchange/contractor/stroitelstvo',
        ];

        foreach($data as $from=>$to)
        {
            if($from == Yii::$app->request->url)
            {
                return Yii::$app->controller->redirect($to,301);
            }
        }
    }

}
