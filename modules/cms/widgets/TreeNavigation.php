<?php
namespace app\modules\cms\widgets;

use app\modules\cms\models\Page;
use yii\base\Widget;

class TreeNavigation extends Widget{

    public $model;

    public function run()
    {
        $model = new Page();
        $data = $model->getParents();
        $items = [];
        $model->makeTree($data,0,$items,Page::DIR);
        return $this->render('TreeNavigationView',[
            'items'=>$items,
        ]);
    }

}