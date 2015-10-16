<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 25.07.15
 * Time: 21:06
 */

namespace app\modules\cms\widgets;

use \Yii;
use yii\base\Widget;
use yii\helpers\Url;

class Feedback extends Widget{
    public function run()
    {
        $model = new \app\modules\cms\models\form\Feedback();
        return $this->render('feedback',['model'=>$model]);
    }

}