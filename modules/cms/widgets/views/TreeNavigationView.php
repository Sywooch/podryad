<?php
/* @var $items app\modules\cms\models\Page[] */
use yii\helpers\Html;

$level=0;

echo Html::a('Сайт',['//cms/admin/page']);
foreach($items as $n=>$item)
{
    if($item->level==$level)
        echo Html::endTag('li')."\n";
    else if($item->level>$level)
        echo Html::beginTag('ul')."\n";
    else
    {
        echo Html::endTag('li')."\n";

        for($i=$level-$item->level;$i;$i--)
        {
            echo Html::endTag('ul')."\n";
            echo Html::endTag('li')."\n";
        }
    }

    echo Html::beginTag('li');
    echo Html::a($item->id.':'.$item->title,['/cms/admin/page/index','parentId'=>$item->id]);
    $level=$item->level;
}

for($i=$level;$i;$i--)
{
    echo Html::endTag('li')."\n";
    echo Html::endTag('ul')."\n";
}