<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 30.09.15
 * Time: 15:08
 */

namespace app\modules\cms\widgets;


use app\modules\cms\models\Reference;
use yii\base\Widget;

class Specialization extends Widget{

    public $type = '';
    public $modelName = '';
    public $specializationList = [];

    public function run()
    {
        $model = Reference::findOne(['alias'=>'specializacii']);
        $checked = [];
        if($this->specializationList)
        {
            foreach($this->specializationList as $specialization)
            {
                $checked[]=$specialization->id;
            }
        }
        return $this->render('specialization',['model'=> $model,'type'=>$this->type,'modelName'=>$this->modelName,'checked'=>$checked]);
    }

}