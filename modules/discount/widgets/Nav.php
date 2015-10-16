<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 21.05.15
 * Time: 15:41
 */

namespace app\modules\discount\widgets;


use app\modules\discount\models\Category;
use yii\base\Widget;

class Nav extends Widget{

    public function run()
    {
        $items = Category::find()->where(['parentId'=>0])->all();
        return $this->render('nav',['items'=>$items]);
    }

}