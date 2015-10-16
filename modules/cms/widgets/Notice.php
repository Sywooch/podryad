<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 04.08.15
 * Time: 10:08
 */

namespace app\modules\cms\widgets;


use yii\base\Widget;

class Notice extends Widget{

    public function run()
    {
        $this->render('noticeView');
    }

}