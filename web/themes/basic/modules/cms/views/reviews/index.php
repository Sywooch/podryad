<?php
/**
 * @var $this \yii\web\View
 * @var $items \app\modules\cms\models\Reviews[]
 */
$this->title = 'Отзывы';
?>

<div class="b-reviews">
    
    <h1 class="b-reviews__title">
        <?=$this->title?>
    </h1>

    <div class="row">
        <?php foreach($items as $item):?>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <img src="<?=$item->image->resize('100x100')?>" alt=""/>
                    <div class="pull-right">
                        <p>Имя: <?=$item->name?></p>
                        <p>Возраст: <?=$item->age?></p>
                        <p>Компания: <?=$item->company?></p>
                        <p><?=$item->content?></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php endforeach?>
    </div>
    
</div>