<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 29.05.15
 * Time: 17:59
 */

namespace app\modules\cms\components\yandexMap;


use yii\base\Widget;
use yii\helpers\Json;

class Map extends Widget{

    public $model;
    public $attribute;
    public $points=[];

    public function run()
    {
        $view = $this->getView();
        IvphpanMapAsset::register($view);
        $cords = '';
        if($this->model && $this->attribute)
        {
            $cords = $this->model->{$this->attribute};
            if(empty($cords))
                return false;
        }

        return $this->render('map',['cords'=>$cords,'points'=>$this->points]);
    }

}