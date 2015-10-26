<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 12.10.15
 * Time: 12:31
 * @var $modelList \app\modules\cms\models\Rate[]
 * @var $inModel string
 * @var $primaryKey integer
 * @var $this \yii\web\View
 */
$this->registerJsFile(\yii\helpers\Url::base().'/site/js/rate.js',[
    'position'=>\yii\web\View::POS_END,
    'depends'=>'\yii\web\JqueryAsset',
]);
$className = $inModel::className();
?>
<div class="contractor-block-info__rating">

    <?php if(!\Yii::$app->user->isGuest):?>
    <input type="hidden" name="<?=\Yii::$app->request->csrfParam?>" value="<?=\Yii::$app->request->csrfToken?>" class="__item-rating_csrf"/>
    <input type="hidden" class="__item-rating_classname" value="<?=$inModel::className()?>"/>
    <input type="hidden" class="__item-rating_primaryKey" value="<?=$primaryKey?>"/>
    <?php endif?>

    <?php foreach ($modelList as $item): ?>
       <div class="ocenki_rat"> <a href="#" title="" class="__item-rating" data-id="<?=$item->id?>"><?=$item->title?> <var class=" _count"><?= $item->getTotalRate($className,$primaryKey) ?></var></a></div>
    <?php endforeach ?>

   <div class="contractor-block-info__rating--message" style="display: none"></div>
    <div class="contractor-block-info__rating--error" style="display: none"></div>
</div>
 