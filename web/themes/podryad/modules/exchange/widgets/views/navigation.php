<?php
/**
 * @var $root \app\modules\cms\models\Reference
 * @var $model \app\modules\cms\models\Reference
 */
?>
<div class="filter">
    <?= \app\modules\cms\widgets\City::widget() ?>
    <?php foreach($root->children() as $item):?>
    <div class="filter__item <?=$item->id == $model->parent->id ? 'active' : ''?>">
        <span class="before"></span> <a class="filter__title" href="<?=$item->url?>">
            <?=$item->title?>
        </a>
        <?php if (($childrens = $item->children())): ?>
        <div class="filter__list <?= $item->id == $model->parent->id ? 'active' : '' ?>">
            <?php foreach($childrens as $children):?>
            <a class="filter-item <?=$children->id == $model->id ? 'active' : ''?>" href="<?=$children->url?>"><?=$children->title?></a>
            <?php endforeach?>
        </div>
        <?php endif ?>
    </div>
    <?php endforeach?>
</div>
