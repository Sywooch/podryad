<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 19.05.16
 * Time: 20:14
 */

namespace app\modules\exchange\controllers;

use app\modules\exchange\models\Projecthouse;
use yii\web\Controller;

class ProjectHouseController extends Controller
{

    public function actionIndex()
    {
        $modelList = Projecthouse::find()->all();
        return $this->render('index',['modelList'=>$modelList]);
    }

}
