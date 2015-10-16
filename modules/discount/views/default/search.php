<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $items \yii\data\ActiveDataProvider */
/* @var $navigation app\modules\discount\models\Category[] */
$title = 'Результаты поиска по запросу "'.\yii\helpers\Html::encode($q).'"';
$this->title = $title;
$info = \Yii::t(
    'app',
    'В корзине: {n, plural, =0{ничего не найдено} one{найдена # услуга} few{найдены # услуги} other{найдены # услуг}}!',
    ['n' => $items->totalCount]
);
?>

<div class="content">
    <div class="title">
        <h1><?=$title?></h1>
        <p><?=$info?></p>
        <?=\yii\widgets\Breadcrumbs::widget([
            'links'=>[],
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
            'pagination' => $items->pagination,
            'prevPageCssClass'=>'pager-previo',
            'lastPageCssClass'=>'last',
            'nextPageCssClass'=>'pager-next',
        ]) ?>
    </div>
</div>