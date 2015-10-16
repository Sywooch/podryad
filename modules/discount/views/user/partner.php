<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
$this->title = 'Партнерская программа';
?>

<div class="panel panel-info">
    
    <div class="panel-heading">Условия:</div>
    <div class="panel-body">
        <p>
            Для того, чтобы участвовать в партнерской программе:
        </p>
        <p>
            Вы должны сказать другу свой email, он должен ввести это в соответствующее поле при активации.
        </p>
    </div>
</div>

<?php if($items->getTotalCount()):?>
<div class="panel panel-info">
    
    <div class="panel-heading">Приглашенные:</div>
    <div class="panel-body">
        <?php
        echo GridView::widget([
            'dataProvider'=>$items,
            'columns'=>[
                'user.username',
                'user.dateCreate',
            ]
        ]);
        ?>
    </div>
</div>
<?php endif;?>

<?php if($historyList->totalCount):?>
<div class="panel panel-info">
    
    <div class="panel-heading">Финансовая история:</div>
    <div class="panel-body">
        <?php
        echo GridView::widget([
            'dataProvider'=>$historyList,
            'columns'=>[
                'date',
                'typeValue',
                'typeSum',
            ]
        ]);
        ?>
    </div>
</div>
<?php endif; ?>
