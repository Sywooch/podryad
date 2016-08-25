<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 03.10.15
 * Time: 15:23
 */

namespace app\modules\exchange\widgets;


use app\modules\cms\models\Reference;
use app\modules\exchange\models\Tender;
use yii\base\Widget;
use yii\helpers\Html;

class SpecializationFilter extends Widget{

    public $filterModel;
    public $specialization = 'specializacii';
    public $checked = [];
    public $priceUse = false;

    public function run()
    {
        $minMaxPrice = [];
        $tender = new \stdClass();

        $model = Reference::find()->where(['alias'=>$this->specialization])->one();

        if($this->priceUse)
        {
            $tender = new Tender();
            $tender->scenario = 'filter';

            $minMaxPrice = $tender->getMinMaxPrice();

            if (!$tender->load($_GET)) {
                $tender->priceMin = $minMaxPrice['min'];
                $tender->priceMax = $minMaxPrice['max'];
            }
        }
        $action = $this->priceUse ? ['/exchange/tender'] : ['/exchange/contractor','specialization'=>$this->specialization];
        return $this->render('specializationFilter',
            [
                'model'=>$model,
                'checked'=>$this->checked,
                'minMaxPrice'=>$minMaxPrice,
                'tender'=>$tender,
                'specialization'=>$this->specialization,
                'priceUse'=>$this->priceUse,
                'filterModel'=>$this->filterModel,
                'action'=>$action,
            ]);
    }

}
