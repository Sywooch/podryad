<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 19.08.16
 * Time: 9:43
 */

namespace app\modules\exchange\widgets;


use app\modules\cms\models\Reference;
use yii\base\Widget;

class Navigation extends Widget
{
    public $model = null;
    public function run()
    {
        if($this->model == null)
        {
            $root = Reference::find()->where(['alias' => 'specializacii'])->one();
        }else{
            $parents = $this->model->parents();
            if (sizeof($parents) == 1) {
                $root = $this->model;
            } else {
                array_shift($parents);
                $root = array_shift($parents);
            }
        }


        return $this->render('navigation',['model'=>$this->model,'root'=>$root]);
    }

}
