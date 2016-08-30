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

$btn = \Yii::$app->controller->route == 'cms/default/index' ? 'Найти подрядчиков' : 'Выбрать';

?>
<div id="specialization" class="modal specialization _specialization" data-count="<?=$count?>">
    <div class="modal__close">x</div>
    <div class="modal__title">Выберите специализации<span class="specialization__btn specialiation-button" data-model="<?= $modelName?>"><?=$btn?></span></div>
    <div class="specialization-list">
        <?php foreach($model->children() as $submodel):?>
        <div class="specialization-column" data-category="<?=$submodel->alias?>">
            <div class="specialization-column__title"><?=$submodel->title?></div>
            <?php if( ($categoryList = $submodel->children()) ):?>
            <div class="specialization-item">
                <?php foreach($categoryList as $category):?>
                    <div class="specialization-item__title"><?=$category->title?></div>
                    <?php if (($items = $category->children())): ?>
                        <?php foreach ($items as $item): ?>
                            <a href="#" data-id="<?=$item->id?>" data-type="<?=$type?>" <?=in_array($item->id,$checked) ? 'class="active" ' : ''?>><?=$item->title?></a>
                        <?php endforeach ?>
                    <?php endif ?>
                <?php endforeach?>
            </div>
            <?php endif?>
        </div>
        <?php endforeach?>
    </div>
    <div class="specialization-list-selected" style="display: none"></div>
</div>
