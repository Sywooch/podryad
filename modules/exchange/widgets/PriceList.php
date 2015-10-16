<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 06.10.15
 * Time: 16:02
 */

namespace app\modules\exchange\widgets;


use app\modules\exchange\models\ContractorPrice;
use yii\data\ActiveDataProvider;
use yii\jui\Widget;

class PriceList extends Widget{

    public function run()
    {
        $userId = \Yii::$app->user->id;
        $dataProvider = new ActiveDataProvider([
            'query'=>ContractorPrice::find()->where(['userId'=>$userId])->priceOrder()
        ]);
        return $this->render('priceList',['dataProvider'=>$dataProvider]);
    }

}