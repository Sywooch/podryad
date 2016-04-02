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
use yii\helpers\Url;
$title = $model->metaTitle ? $model->metaTitle : $model->title;

$this->title = $title;
$this->registerMetaTag(['name' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['name' => 'og:description', 'content' => $model->metaDescription]);
$this->registerMetaTag(['name' => 'twitter:description', 'content' => $model->metaDescription]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->metaKeywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->metaDescription]);
$offers = $model->offers;
$offersCount = sizeof($offers);

$this->params['breadcrumbs'] = [
  ['label'=>'Тендеры','url'=>['/exchange/tender']],
    $model->h1
];
?>
<main class="main">
    <div class="tender_cotainer">
        <a href="<?=\yii\helpers\Url::previous()?>" title="" class="contractor-back">Вернуться к списку тендеров</a>
        <div class="tender_item__cotainer">
		<div class="tender_content_vnutr">
            <div class="tender_item_des">
				<div class="tender_item_des_title">
					<h1><?=$model->title?></h1>
				</div>
				<span  class="accaunt_tender_item_btn ">Тендер <?=$model->statusTitle?></span>
                <div class="contractor-block-info__service">Города: <?=$model->user->profile->getCityListString()?></div>
                <div class="contractor-block-info__service"><?=$model->specializationsString?></div>
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
                        <?php if(\Yii::$app->user->isGuest && $model->active == \app\modules\exchange\models\Tender::IS_OPEN){?>
                            <a href="<?=\yii\helpers\Url::to(['/cms/users/register','scenario'=>\app\modules\cms\models\User::ROLE_CONTRACTOR])?>" title="" class="zakaz__btn">
                                УЧАствовать в
                                ТЕНДЕРе
                            </a>
                        <?php }elseif(Yii::$app->user->isGuest==false && \Yii::$app->user->identity->role == \app\modules\cms\models\User::ROLE_CONTRACTOR && !in_array(\Yii::$app->user->id,$model->offersListId) && $model->active==\app\modules\exchange\models\Tender::IS_OPEN){?>
                            <a href="#" title="" data-click="modal" data-item="#zakaz_tender" class="zakaz__btn">
                                УЧАствовать в
                                ТЕНДЕРе
                            </a>
                        <?php }?>

                    <?=\app\modules\exchange\widgets\OffersForm::widget(['tenderId'=>$model->id])?>
                    <?php endif;?>
                </div>
            </div>

			

            <div class="tender tender_item_count">
                Предложений: <?=$offersCount?>
            </div>
            <?php foreach($offers as $offer):?>
            <div class="tender_item <?=$model->cssSelected($offer->id)  ?>">
                <div class="tender_item-avatar">
                   <a href="<?=\yii\helpers\Url::to(['/exchange/contractor/view','id'=>$offer->user->id])?>"> <img src="<?=$offer->user->profile->imageSrc('197x125')?>" alt="">
  </a>
                    <div class="status_date">
                        <span>Предложение добавлено:</span>
                        <?=$offer->date?>
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
					<?php if (($city = $offer->user->profile->city->title)): ?>
                        <div class="contractor-block-info__contact contractor-block-info__contact--city">
                           Город: <?=$city?>
                        </div>
                    <?php endif ?>
                    <div class="tender_item_content_cena">Стоимость работ: <span><?=$offer->price?> тг.</span></div>
                    <p><?=Html::encode($offer->description)?>
                    </p>
					
					<div class="info_block">
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
                    <?php if (($site = $offer->user->profile->site)): ?>
                        <div class="contractor-block-info__contact contractor-block-info__contact--site">
                            <a href="#" title="" data-show="<?= $site ?>" class="contractor-block-info-show">показать
                                сайт
                            </a>
                        </div>
                    <?php endif ?>

                    <?php if (($address = $offer->user->profile->adres)): ?>
                        <div class="contractor-block-info__contact contractor-block-info__contact--address">
                            <a href="#" title="" data-show="<?= $address ?>" class="contractor-block-info-show">показать
                                адрес
                            </a>
                        </div>
                    <?php endif ?>
					</div>
					
                    <?= \app\modules\cms\widgets\Rate::widget(['model' => $offer->user, 'primaryKey' => $offer->user->id]) ?>
                </div>
            </div>
			<?php endforeach?>
        </div>
         <div class="tender_zakazchik">
				<div class="tender_zakaz_titile">
					Заказчик
				</div>
				<div class="zakaz_info">
					<div class="tender_zakaz-avatar">
						<img src="<?=$model->user->profile->imageSrc('197x125')?>" alt="">
					</div>
					<div class="info_zakaz_client">
					<div class="tender_zakazchik_name">
						<?=$model->user->title?>
					</div>
                    <?php if($model->isOfferSelected()):?>
					<div class="contractor-block-info__contact contractor-block-info__contact--phone">
						<a href="#" title="" data-show="<?= $model->user->profile->phone ?>" class="contractor-block-info-show">показать
							номер
						</a>
					</div>
					<?php else: ?>
					<div class="contractor-block-info__contact contractor-block-info__contact--zamok ">
						Чтобы увидеть контакты Заказчика, он должен  Вас выбрать
					</div>
                    <?php endif?>
                    <?php if($model->isOfferSelected()):?>
					<div class="contractor-block-info__contact contractor-block-info__contact--email">
						<a href="#" title="" data-show="<?= $model->user->username ?>" class="contractor-block-info-show">показать
							e-mail
						</a>
					</div>
                    <?php endif?>
                    <?php if (($adres = $model->user->profile->adres) && $model->isOfferSelected()): ?>
                        <div class="contractor-block-info__contact contractor-block-info__contact--address">
                            <a href="#" title="" data-show="<?= $adres?>"
                               class="contractor-block-info-show">показать
                                адрес
                            </a>
                        </div>
                    <?php endif ?>
                    <?php if (($site = $model->user->profile->site) && $model->isOfferSelected()): ?>
                        <div class="contractor-block-info__contact contractor-block-info__contact--site">
                            <a href="#" title="" data-show="<?= $site ?>"
                               class="contractor-block-info-show">показать
                                сайт
                            </a>
                        </div>
                    <?php endif ?>
					</div>
				</div>
			</div>
			   </div>
       
</main>