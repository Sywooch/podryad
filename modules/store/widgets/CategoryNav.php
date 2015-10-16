<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 07.08.15
 * Time: 16:10
 */

namespace app\modules\store\widgets;


use yii\base\Widget;

class CategoryNav extends Widget{

    public function run()
    {
        $alias = \Yii::$app->request->get('alias');
        if(\Yii::$app->controller->route != 'store/category/brand')
        {
            $type = 'category';
            $items = \app\modules\store\models\Category::getNavigationData();
        }else
        {
            $type = 'brand';
            $items = \app\modules\store\models\Manufacturer::getNavigationData();
        }
        return $this->render('categoryNavView',['items'=>$items,'type'=>$type,'alias'=>$alias]);
    }
}