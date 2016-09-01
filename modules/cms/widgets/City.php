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
                if(\Yii::$app->controller->route == 'exchange/tender/index')
                {
                    \Yii::$app->controller->refresh();
                }else{
                    $refererer = \Yii::$app->request->url;
                    $refererArray = explode('/', $refererer);
                    $city = end($refererArray);
                    if (Reference::findOne(['alias' => $city,'parentId'=>1])) {
                        array_pop($refererArray);
                    }
                    array_push($refererArray, $model->alias);
                    $url = implode('/', $refererArray);
                    \Yii::$app->controller->redirect($url);
                }
            }
        }elseif(isset($_POST['city']))
        {
            \Yii::$app->response->cookies->remove('city');
            $refererer = \Yii::$app->request->url;
            $refererArray = explode('/', $refererer);
            $city = end($refererArray);
            if (Reference::findOne(['alias' => $city, 'parentId' => 1])) {
                array_pop($refererArray);
            }
            $url = implode('/', $refererArray);
            \Yii::$app->controller->redirect($url);
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
