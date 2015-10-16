<?php
/**
 * @var $this \yii\web\View
 * @var $item \app\modules\cms\models\Article
 * @var $items \app\modules\cms\models\Article[]
 */
$this->title = $item->typeView;
?>
<div class="article-block">
    <h1 class="article-block__head"><?=$this->title?></h1>


        <?php foreach($items as $item):?>

            <div class="media">
        <div class="media-left">
            <a href="#">
                <img class="article-block__image media-object" src="<?=$item->image->resize('100x100')?>" alt="pic-<?=$item->image->id?>"/>
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><?=$item->title?></h4>
            <small><?=\Yii::$app->formatter->asDate(strtotime($item->dateCreate))?></small>
            <br/>
            <p>
                <?=$item->shortext(300)?>

            </p>
            <div class="pull-right">
                <a href="<?=$item->path?>" class="btn btn-success bnt-xs">Подробнее</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
        <?php endforeach?>

</div>