<?php
/**
 * @var $model \app\modules\cms\models\form\PriceForm
 * @var $subject string
 */
use \Yii;
?>
<h1><?=$subject?></h1>
<ul>
    <li>
        <strong>Страница:</strong> <?=$model->price->obj->title?>
    </li>
    <?php if($model->price->price):?>
    <li>
        <strong>Цена:</strong> <?=$model->price->price?>
    </li>
    <?php endif?>
    <li>
        <strong>Имя:</strong> <?=$model->name?>
    </li>
    <li>
        <strong>Телефон:</strong> <?=$model->phone?>
    </li>
    <li>
        <strong>Отделение:</strong> <?= $model->section ?>
    </li>
    <li>
        <strong>Дата записи:</strong> <?=$model->date?>
    </li>
</ul>