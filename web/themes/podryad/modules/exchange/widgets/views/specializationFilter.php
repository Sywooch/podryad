<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 03.10.15
 * Time: 15:25
 * @var $model \app\modules\cms\models\Reference
 * @var $tender \app\modules\exchange\models\Tender
 * @var $checked array
 * @var $action array
 * @var $filterModel string
 * @var $specialization string
 * @var $priceUse bool
 * @var $minMaxPrice array
 */
?>

<div class="search-contractor-content__title">Фильтр</div>
<form method="get" action="" class="filter">
    <?php if($specialization == 'specializacii'):?>
    <?php foreach($model->children() as $part1):?>
    <div class="filter_container_title"><?= $part1->title?></div>
        <?php foreach($part1->children() as $part2):?>
            <div class="filter__item">
                <div class="filter__title"><?=$part2->title?></div>
                <div class="filter__select-all">Выбрать все</div>
                <div class="filter__list">
                    <?php foreach($part2->children() as $part3):?>
                    <div class="filter-item<?= in_array($part3->id, $checked) ? ' active' : '' ?>"><?=$part3->title?>
                        <input type="checkbox" name="<?= $filterModel ?>[specializationIds][]" value="<?=$part3->id?>" <?=in_array($part3->id,$checked) ? 'checked="checked"':''?>>
                    </div>
                    <?php endforeach?>
                </div>
            </div>
        <?php endforeach?>
    <?php endforeach?>
    <?php else:?>
        <input name="specialization" type="hidden" value="<?= $specialization ?>"/>
        <?php foreach($model->children() as $part1):?>
        <div class="filter__item">
            <div class="filter__title"><?=$part1->title?></div>
            <div class="filter__select-all">Выбрать все</div>
            <div class="filter__list">
                <?php foreach ($part1->children() as $part2): ?>
                    <div class="filter-item<?= in_array($part2->id, $checked) ? ' active' : '' ?>"><?= $part2->title ?>
                        <input type="checkbox" name="<?= $filterModel ?>[specializationIds][]"
                               value="<?= $part2->id ?>" <?= in_array($part2->id, $checked) ? 'checked="checked"' : '' ?>>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <?php endforeach?>
    <?php endif?>

    <?php if($minMaxPrice):?>
    <div class="filter-cost">
        <div class="filter-cost__title">Бюджет, тенге</div>
        <div class="filter-cost-value">
            <input name="min" type="hidden" value="<?= $minMaxPrice['max'] ?>" id="cost-line-max" disabled="disabled"/>
            <input name="max" type="hidden" value="<?= $minMaxPrice['min'] ?>" id="cost-line-min" disabled="disabled"/>
            <input type="text" value="<?=$tender->priceMax?>" id="cost-line-value-max" class="filter-cost-value__input" name="<?= $filterModel ?>[priceMin]"><span>—</span>
            <input type="text" value="<?= $tender->priceMin ?>" id="cost-line-value-min" class="filter-cost-value__input"
                   name="<?= $filterModel ?>[priceMax]">
    </div>
        <div id="cost-line" class="filter-cost__line noUi-target noUi-ltr noUi-horizontal noUi-background">
            
        </div>
    </div>
    <?php endif?>

    <input type="submit" value="Найти" class="filter__submit">
    <a href="<?=\yii\helpers\Url::to($action)?>" class="filter__reset">
        Сбросить фильтр
    </a>

    <div class="filter__nofilter">Не нашли подходящий фильтр?
        <a href="#" title="" data-click="modal" data-item="#back_hunter">Предложите его нам</a>
    </div>
</form>