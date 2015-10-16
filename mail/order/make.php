<?php
/**
 * @var $model \app\modules\store\models\Order
 * @var $subject string
 */?>

<h1><?=$subject?></h1>

<p>Вы успешно сделали заказ на сайте!</p>

<h2>Заказ №<?=$model->id?></h2>

<h3>Заказанные товары</h3>

<table style="width: 90%;" border="1">
    <tfoot>
    <tr>
        <td colspan="3" style="text-align: right;padding-right: 20px">
            Всего: <?=$model->totalCount()?> шт.

        </td>
    </tr>
    </tfoot>
    <thead>
    <tr>
        <td>#</td>
        <td>Наименование</td>
        <td>Кол-во</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($model->products as $i=>$item):?>
    <tr>
        <td><?=$i+1?></td>
        <td><?=$item->product->title?></td>
        <td><?=$item->quantity?></td>
    </tr>
    <?php endforeach?>
    </tbody>
</table>