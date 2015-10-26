<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 02.10.15
 * Time: 17:22
 * @var $this \yii\web\View
 * @var $model \app\modules\exchange\models\Tender
 */
use yii\helpers\Html;

$title = $model->title;
$city = 'г. '.$model->user->profile->city->title;

$this->title = $title.' - '.$city;
$this->registerMetaTag(['description'=>$model->shortext(255,true)]);
$this->registerMetaTag(['keywords'=>$title.' '.$city]);
$offers = $model->offers;
$offersCount = sizeof($offers);
?>
<main class="main">
    <div class="tender_cotainer">
        <a href="<?=\Yii::$app->request->referrer?>" title="" class="contractor-back">Вернуться к списку тендеров</a>
        <div class="tender_item__cotainer">
            <div class="tender_item_des">
                <h1 class="tender_item_des_title"><?=$model->title?></h1>
                <div class="contractor-block-info__service"><?=$model->user->profile->city->title?></div>
                <div class="contractor-block-info__service"><?=$model->specialization->title?></div>
                <p><?=$model->description?>
                </p>
                <div class="tender_item_des_info">
                    <div class="tender_item_des_info_status">
                        <b>Тендер открыт:</b> <span><?=$model->date?></span>
                    </div>
                    <div class="tender_item_des_info_biudzhet">
                        Бюджет: <span><b><?=$model->priceString?></b></span>
                    </div>
                    <?php if($model->image):?>
                    <a href="<?=$model->imageSrc('800x600')?>" title="<?= $this->title ?>" class="swipebox">
                        <div class="tender_item_des_info_photo">
                            Изображение
                        </div>
                    </a>
                    <?php endif?>

                    <?php if($model->isMine() == false):?>
                        <?php if(\Yii::$app->user->isGuest){?>
                            <a href="<?=\yii\helpers\Url::to(['/cms/users/register','scenario'=>\app\modules\cms\models\User::ROLE_CONTRACTOR])?>" title="" class="zakaz__btn">
                                УЧАствовать в
                                ТЕНДЕРе
                            </a>
                        <?php }elseif(\Yii::$app->user->identity->role == \app\modules\cms\models\User::ROLE_CONTRACTOR){?>
                            <a href="#" title="" data-click="modal" data-item="#zakaz_tender" class="zakaz__btn">
                                УЧАствовать в
                                ТЕНДЕРе
                            </a>
                        <?php }?>

                    <?=\app\modules\exchange\widgets\OffersForm::widget(['tenderId'=>$model->id])?>
                    <?php endif;?>
                </div>
            </div>
			 <div class="tender_zakazchik">
            <div class="tender_zakaz_titile">
                Заказчик
            </div>
            <div class="zakaz_info">
                <div class="tender_zakaz-avatar">
                    <img src="<?=$model->user->profile->imageSrc('197x125')?>" alt="">
                </div>
                <div class="tender_zakazchik_name">
                    <?=$model->user->profile->fio?>
                </div>
                <div class="contractor-block-info__contact contractor-block-info__contact--phone">
                    <a href="#" title="" data-show="<?= $model->user->profile->phone ?>" class="contractor-block-info-show">показать
                        номер
                    </a>
                </div>
                <div class="contractor-block-info__contact contractor-block-info__contact--email">
                    <a href="#" title="" data-show="<?= $model->user->username ?>" class="contractor-block-info-show">показать
                        e-mail
                    </a>
                </div>
            </div>
        </div>
            <div class="tender tender_item_count">
                Предложений: <?=$offersCount?>
            </div>
            <?php foreach($offers as $offer):?>
            <div class="tender_item <?=$model->cssSelected($offer->id)  ?>">
                <div class="tender_item-avatar">
                    <img src="<?=$offer->user->profile->imageSrc('197x125')?>" alt="">

                    <div class="status_date">
                        <span>Предложение добавлено:</span>
                        <?=$offer->dateAdd?>
                    </div>
                </div>
                <div class="tender_item_content">

                    <?php if($model->isMine() && $model->isOpen()):?>
                    <div class="contractor-block-info__panel">
                        <a class="contractor-block-info-use" href="<?=\yii\helpers\Url::to(['/exchange/offers/contractor-set','id'=>$offer->id])?>">
                            Принять
                        </a>
                    </div>
                    <?php endif?>

                    <div class="contractor-block-info__name">
                        <a href="<?=\yii\helpers\Url::to(['/exchange/contractor/view','id'=>$offer->user->id])?>">
                        <?=$offer->user->title ?>
                        </a>
                    </div>
                    <div class="contractor-block-info__contact contractor-block-info__contact--phone">
                        <a href="#" title="" data-show="<?= $offer->user->profile->phone ?>" class="contractor-block-info-show">показать
                            номер
                        </a>
                    </div>
                    <div class="contractor-block-info__contact contractor-block-info__contact--email">
                        <a href="#" title="" data-show="<?= $offer->user->username ?>" class="contractor-block-info-show">показать
                            e-mail
                        </a>
                    </div>
                    <div class="tender_item_content_cena">Стоимость работ: <span><?=$offer->price?> тг.</span></div>
                    <p><?=Html::encode($offer->description)?>
                    </p>
                    <?= \app\modules\cms\widgets\Rate::widget(['model' => $offer, 'primaryKey' => $offer->id]) ?>
                </div>
            </div>
        </div>
        <?php endforeach?>
       
</main>