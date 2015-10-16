<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 17.08.15
 * Time: 12:17
 */

namespace app\modules\cms\widgets\admin;


use yii\base\Widget;

class Price extends Widget{

    public $object;
    public $objectId;

    public function run()
    {
        $object = $this->object;
        $className=  $object::className();

        $model = \app\modules\cms\models\Price::findByObject($className,$this->objectId);
        if(!$model)
        {
            $model = new \app\modules\cms\models\Price();
        }
        $model->object = $className;
        $model->objectId = $this->objectId;
        return $this->render('price',['model'=>$model]);
    }

}