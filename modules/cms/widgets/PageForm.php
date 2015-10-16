<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 06.05.15
 * Time: 12:44
 */

namespace app\modules\cms\widgets;


use yii\base\Widget;

class PageForm extends Widget{

    public $model;

    public function run()
    {
        return $this->render('PageFormView',['model'=>$this->model]);
    }

}