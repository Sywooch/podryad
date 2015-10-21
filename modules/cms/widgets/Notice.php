<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 04.08.15
 * Time: 10:08
 */

namespace app\modules\cms\widgets;

use kartik\growl\Growl;
use yii\base\Widget;

class Notice extends Widget{

    public function run()
    {
        if(\Yii::$app->session->hasFlash('success'))
        {
            return Growl::widget([
                'type' => Growl::TYPE_SUCCESS,
                'icon' => 'glyphicon glyphicon-ok-sign',
                'title' => 'Всё успешно!',
                'showSeparator' => true,
                'body' => \Yii::$app->session->getFlash('success'),
                'delay'=>1000,
            ]);
        }
//       $this->render('test');
    }

}