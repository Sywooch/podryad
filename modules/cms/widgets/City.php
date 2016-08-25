<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 15.10.15
 * Time: 15:07
 */

namespace app\modules\cms\widgets;


use app\modules\cms\models\Reference;
use yii\bootstrap\Widget;
use yii\web\Cookie;

class City extends Widget{

    public function run()
    {
        $model = null;

        if(!empty($_POST['city']))
        {
            $model = Reference::findOne($_POST['city']);
            if($model)
            {
                \Yii::$app->response->cookies->add(
                    new Cookie([
                        'name'=>'city',
                        'value'=>$_POST['city']]
                    )
                );
                \Yii::$app->controller->redirect('/');
            }
        }elseif(isset($_POST['city']))
        {
            \Yii::$app->response->cookies->remove('city');
            \Yii::$app->controller->refresh();
        }
        $modelList = Reference::getCityList();
        if(!empty(\Yii::$app->request->cookies['city']))
        {
            $cityId = \Yii::$app->request->cookies['city'];
            $model = Reference::findOne($cityId);
        }
        return $this->render('city',['model'=>$model,'modelList'=>$modelList]);
    }

}
