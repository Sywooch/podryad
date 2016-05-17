<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 30.09.15
 * Time: 15:12
 * @var $model \app\modules\cms\models\Reference
 * @var $type string
 * @var $modelName string
 * @var $checked array
 */
?>
<div id="<?=$template?>" class="modal _specialization" data-count="10">
    <div class="modal__close">x</div>
    <div class="modal__title">Выберите города<span class="city__btn specialization__btn" data-model="<?= $modelName?>">Выбрать</span></div>
    <div class="specialization-list">
        <div class="specialization-column" data-category="">
            <div class="specialization-column__title"></div>
            <div class="specialization-item">
                <div class="specialization-item__title"></div>
                <?php if (($items = $model->children())): ?>
                    <?php foreach ($items as $item): ?>
                        <a href="#" data-id="<?=$item->id?>" data-type="<?=$type?>" <?=in_array($item->id,$checked) ? 'class="active" ' : ''?>><?=$item->title?></a>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="city-list-selected" style="display: none"></div>
</div>
