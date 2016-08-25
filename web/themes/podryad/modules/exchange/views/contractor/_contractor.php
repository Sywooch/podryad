<?php
/**
 * @var $model \app\modules\exchange\models\Contactor
 */

use yii\helpers\Url;
use app\modules\exchange\models\Album;
use alexBond\thumbler\Thumbler;

?>
<div class="contractor-block-avatar">
    <a href="<?= Url::to(['/exchange/contractor/view', 'id' => $model->id]) ?>"><img
            src="<?= $model->profile->imageSrc('199x159') ?>" alt="">
    </a>
    <?php if (\Yii::$app->user->isGuest) { ?>
        <a href="#" title="" class="contractor-block-avatar__btn _contractor" data-click="modal"
           data-item="#enter">ПРИГЛАСИТЬ НА ТЕНДЕР
        </a>
    <?php } elseif (\Yii::$app->user->can(\app\modules\cms\models\User::ROLE_CUSTOMER)) { ?>
        <a href="<?= Url::to(['/exchange/tender/my', 'contractorId' => $model->id]) ?>"
           title="" class="contractor-block-avatar__btn _inviteToTender"
           data-click="modal" data-item="#inviteToTenderWindow">ПРИГЛАСИТЬ НА
            ТЕНДЕР
        </a>
    <?php } ?>
</div>
<div class="contractor-block-info">
    <div class="contractor-block-info__name">
        <a href="<?= Url::to([
            '/exchange/contractor/view',
            'id' => $model->id,
        ]) ?>"> <?= $model->title ?>
        </a>
    </div>
    <div class="contractor-block-info__contact contractor-block-info__contact--city">
        Города: <?= $model->profile->getCityListString() ?>
    </div>
    <div class="contractor-block-info__service">Предлагаемые услуги
        <a href="#" title="" data-show="<?= $model->profile->specializationsString ?>"
           class="contractor-block-info-show">
            показать
        </a>
    </div>
    <div class="portfolio-album__count">Фото<span><?= $model->photoCount ?></span></div>
    <div class="contractor-block-images">
        <?php foreach (Album::getAllImagesByUser($model->id, 6) as $image): ?>
            <a href="<?= Url::to(['/exchange/contractor/view', 'id' => $model->id]) ?>" title="">
                <img src="<?= $image->imageSrc('95x76', Thumbler::METHOD_CROP_CENTER) ?>" alt="">
            </a>
        <?php endforeach ?>
    </div>
</div>
