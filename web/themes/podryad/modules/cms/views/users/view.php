<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 30.09.15
 * Time: 17:28
 * @var $this \yii\web\View
 * @var $model \app\modules\cms\models\User
 * @var $tender \app\modules\exchange\models\Tender
 */
use yii\helpers\Html;
$this->title = 'Личный кабинет:';
?>
<main class="main">
    <div class="accaunt_block">
        <div class="contractor-block-avatar"><img src="<?=$model->profile->imageSrc('197x125')?>" alt=""></div>
        <div class="accaunt_name">
            <?=$model->profile->fio?>
        </div>
        <div class="contractor-block-info__contact contractor-block-info__contact--phone">
            <a href="#" title="" data-show="<?=$model->profile->phone?>" class="contractor-block-info-show">показать номер</a>
        </div>
        <div class="contractor-block-info__contact contractor-block-info__contact--email">
            <a href="#" title="" data-show="<?=$model->username?>" class="contractor-block-info-show">показать e-mail</a>
        </div>
        <?php if(!\Yii::$app->user->isGuest && $model->id == \Yii::$app->user->id):?>
        <div class="contractor-block-info__contact contractor-block-info__contact--edit">
            <a href="<?=\yii\helpers\Url::to(['/cms/users/update'])?>" title="" class="contractor-block-info-show-edit">Редактировать</a>
        </div>
        <?php endif?>
    </div>

    <div class="accaunt_tender_container">
        <div class="accaunt_tender title">
            Мои тендеры
        </div>

        <div class="announce-tender">
            <div class="announce-tender__baner"><img
                    src="<?= $this->theme->getUrl('static/images/content/announce-tender-baner.jpg') ?>" alt="">
            </div>
            <?= Html::beginForm(['/exchange/tender/create'], 'post', [
                'class' => 'announce-tender-form',
            ]) ?>
            <?= Html::errorSummary($tender) ?>
            <?= Html::activeTextInput($tender, 'title', ['placeholder' => 'Укажите название (Например: Нужно сделать теплые полы 80 кв.м.)', 'class' => 'announce-tender-form__input']) ?>
            <?= Html::activeTextarea($tender, 'description', ['class' => 'announce-tender-form__input announce-tender-form__input--textarea', 'placeholder' => 'Перечень работ (опишите максимально подробно: перечень работ, площадь помещений, сроки выполнения, требования к подрядчикам и т. д.)']) ?>
            <div class="btn btn--tender">
                <input type="submit" value="Объявить тендер" class="announce-tender-form__submit">
            </div>
            <?= Html::endForm() ?>
        </div>

        <div class="contractor-block-info__service">Все <?=\app\modules\exchange\models\Tender::find()->where(['userId'=>$model->id])->count()?></div>

        <?php foreach(\app\modules\exchange\models\Tender::getTenderByUser($model->id) as $tender):?>
        <div class="accaunt_tender_item">
            <div class="accaunt_tender_item_head">
                <a class="accaunt_tender_item title" href="<?=\yii\helpers\Url::to(['/exchange/tender/view','id'=>$tender->id])?>">
                    <?=$tender->title?>
                </a>
                <a href="<?=\yii\helpers\Url::to(['/exchange/tender/view','id'=>$tender->id])?>" title="" class="accaunt_tender_item_btn">Тендер <?=$tender->statusTitle?></a>
            </div>
            <div class="accaunt_tender_item_city_date">
                <div class="accaunt_tender_item_city">
                    <?=$tender->user->profile->city->title?>
                </div>
                <div class="accaunt_tender_item_date">
                    <?=\Yii::$app->formatter->asDatetime(strtotime($tender->dateCreate))?>
                </div>
            </div>
            <div class="accaunt_tender_item_biudzhet_predlozheni">
                <div class="accaunt_tender_item_biudzhet">
                    <?=$tender->price?>
                </div>
                <div class="accaunt_tender_item_predlozheni">
                    Поступило <?=$tender->offersCount?> предложения
                </div>
            </div>
            <div class="accaunt_tender_item_des">
                <p><?=$tender->description?></p>
            </div>
        </div>
        <?php endforeach?>
    </div>
</main>