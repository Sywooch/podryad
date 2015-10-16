<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model app\modules\discount\models\Category */
/* @var $navigation app\modules\discount\models\Category[] */
$title = $model->title;
$this->title = $title;
?>

<div class="lf_sb">
    <div class="l_sb">
        <?php if($navigation):?>
        <ul class="l_sb">
            <?php foreach($navigation as $nav):?>
            <li><i class="fa fa-angle-double-right"></i><a href="<?=Url::to(['/discount/default/category','path'=>$nav->path])?>"><?=$nav->title?></a></li>
            <?php endforeach?>
        </ul>
        <?php endif?>
        <div class="left_block">
            <script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>

            <!-- VK Widget -->
            <div id="vk_groups"></div>
            <script type="text/javascript">
                VK.Widgets.Group("vk_groups", {mode: 0, width: "220", height: "400", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 95056247);
            </script>
        </div>
    </div>
</div>


<div class="content">
    <div class="title">
        <h1><?=$title?></h1>
        <p>Любой текст</p>
        <?=\yii\widgets\Breadcrumbs::widget([
            'links'=>$model->breadcrumbs(),
            'options'=>['class'=>'under_ul'],
            'itemTemplate' => '<li>{link}<i class="fa fa-angle-right"></i></a></li>',
        ])?>
        <div class="soc_seti turizm">
            <?=\Yii::$app->params['socShare']?>
        </div>
    </div>
    <ul class="turizm">
        <?php foreach($items->models as $item) echo $this->render('_serviceCard',['model'=>$item])?>
    </ul>

    <div class="page_schet">
        <?= LinkPager::widget([
            'pagination' => $items->pages,
            'prevPageCssClass'=>'pager-previo',
            'lastPageCssClass'=>'last',
            'nextPageCssClass'=>'pager-next',
        ]) ?>
    </div>
</div>