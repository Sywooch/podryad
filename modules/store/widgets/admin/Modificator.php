<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 14.08.15
 * Time: 14:40
 */

namespace app\modules\store\widgets\admin;


use app\modules\store\models\ModificatorCategorySearch;
use app\modules\store\models\ModificatorUpload;
use yii\base\Widget;

class Modificator extends Widget{
    public $model;
    public function run()
    {
        $modelUpload = new ModificatorUpload();
        $searchModel = new ModificatorCategorySearch();
        $params = \Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);

        return $this->render('modificatorView', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelUpload'=>$modelUpload,
            'modelProduct'=>$this->model,
        ]);
    }

}