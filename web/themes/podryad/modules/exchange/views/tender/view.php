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
            <div class="contractor-block tenders tender-view">
                <div class="contractor-block-avatar">
                    <a href="<?= $model->url ?>">
                        <img src="<?= $model->user->profile->imageSrc('197x125') ?>" alt="">
                    </a>
                    <div class="tenders__name"><?= $model->user->title ?>

                    </div>
                </div>
                <div class="contractor-block-info">
                    <div class="contractor-block-info__name">
                        <span
                           class="contractor-block-info__name-link"><?= Html::encode($model->title) ?></span>
                        <span title=""
                           class="accaunt_tender_item_btn tender_status">Тендер <?= $model->statusTitle ?></span>
                    </div>
                    <div class="tenders__text">Города: <?= $model->user->profile->getCityListString() ?></div>
                    <div class="tenders__text"><?= $model->specializationsString ?></div>
                    <div class="tenders__text">
                        Предложений: <?= $model->offersCount ?>
                    </div>
                    <div class="tenders__text"><?= Html::encode($model->description) ?>
                    </div>
                    <div class="tenders-info">
                        <div class="tenders-info__time"><span>Тендер открыт:	     </span><?= $model->date ?>
                        </div>
                        <div class="tenders-info__budget">Бюджет: <span><?= $model->priceString ?></span></div>
                    </div>
                    <?php if ($model->isMine() == false): ?>
                        <?php if (\Yii::$app->user->isGuest && $model->active == \app\modules\exchange\models\Tender::IS_OPEN) { ?>
                            <a href="<?= \yii\helpers\Url::to(['/cms/users/register', 'scenario' => \app\modules\cms\models\User::ROLE_CONTRACTOR]) ?>"
                               title="" class="tender-btn zakaz__btn">
                                УЧАствовать в
                                ТЕНДЕРе
                            </a>
                        <?php } elseif (Yii::$app->user->isGuest == false && \Yii::$app->user->identity->role == \app\modules\cms\models\User::ROLE_CONTRACTOR && !in_array(\Yii::$app->user->id, $model->offersListId) && $model->active == \app\modules\exchange\models\Tender::IS_OPEN) { ?>
                            <a href="#" title="" data-click="modal" data-item="#zakaz_tender" class="tender-btn zakaz__btn">
                                УЧАствовать в
                                ТЕНДЕРе
                            </a>
                        <?php } ?>

                        <?= \app\modules\exchange\widgets\OffersForm::widget(['tenderId' => $model->id]) ?>
                    <?php endif; ?>
                </div>
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
			   
       
</main>
