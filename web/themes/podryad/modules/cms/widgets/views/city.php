<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 15.10.15
 * Time: 15:08
 * @var $model \app\modules\cms\models\Reference
 * @var $modelList \app\modules\cms\models\Reference[]
 */
?>
<div class="header-city">
    <div class="header-city__title">ВЫБЕРИТЕ ГОРОД:</div>
    <div class="header-city-select">
        <?php if($model):?>
            <div class="header-city-select__current"><?=$model->title?></div>
        <?php else:?>
            <div class="header-city-select__current">Все города</div>
        <?php endif?>

        <div class="header-city-select__list asd">
            <?php if($model):?>
                <div class="header-city-select__option" data-id="">Все города</div>
            <?php endif?>
            <?php foreach($modelList as $item):
                if($item->alias == 'ves-kazahstan') continue;
                ?>
            <div class="header-city-select__option" data-id="<?=$item->id?>"><?=$item->title?></div>
            <?php endforeach?>
        </div>
    </div>
    <?=\yii\helpers\Html::beginForm()?>
    <input type="hidden" value="" class="header-city-select__input" name="city">
    <?=\yii\helpers\Html::endForm()?>
</div>
