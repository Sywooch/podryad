<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 05.10.15
 * Time: 10:32
 * @var $this \yii\web\View
 * @var $model \app\modules\exchange\models\Contactor
 * @var $specialization string
 * @var $specializationModel \app\modules\cms\models\Reference
 * @var $contactorList \app\modules\exchange\models\Contactor[]
 * @var $pages \yii\data\Pagination
 */
$this->title = $specializationModel->title;
if($specializationModel)
{
    $this->registerMetaTag(['name' => 'og:title', 'content' => $this->title]);
    $this->registerMetaTag(['name' => 'og:description', 'content' => $specializationModel->metaDescription]);
    $this->registerMetaTag(['name' => 'twitter:description', 'content' => $specializationModel->metaDescription]);
    $this->registerMetaTag(['name'=>'keywords','content'=>$specializationModel->metaKeywords]);
    $this->registerMetaTag(['name'=>'description','content'=>$specializationModel->metaDescription]);
}
$this->params['breadcrumbs'] = [
    'Подрядчики - '.$specializationModel->title,
];

?>
<main class="main">
    <section class="search-contractor-content">
        <h1 class="search-contractor-content__title">Подрядчики - <?=$specializationModel->title?></h1>
            <?= \app\modules\exchange\widgets\SpecializationFilter::widget(['checked'=>$model->specializationIds,'specialization'=>$specialization,'filterModel'=>'Contactor']) ?>
        <div class="search-contractor-results">
            <div class="search-contractor-results-list">
                <div class="search-contractor-results-list-item">

                    <?php if (!$contactorList): ?>
                        <p>Нет информации</p>
                    <?php endif ?>

                    <?php foreach($contactorList as $contactor):?>
                    <div class="contractor-block">
                        <div class="contractor-block-avatar">
                            <a href="<?= \yii\helpers\Url::to(['/exchange/contractor/view', 'id' => $contactor->id,'specialization'=> $specializationModel->alias]) ?>"><img src="<?=$contactor->profile->imageSrc('199x159')?>" alt="">
                            </a>
                            <?php if (\Yii::$app->user->isGuest) { ?>
                                <a href="#" title="" class="contractor-block-avatar__btn _contractor" data-click="modal"
                                   data-item="#enter">ПРИГЛАСИТЬ НА ТЕНДЕР
                                </a>
                            <?php } elseif (\Yii::$app->user->can(\app\modules\cms\models\User::ROLE_CUSTOMER)) { ?>
                                <a href="<?= \yii\helpers\Url::to(['/exchange/tender/my', 'contractorId' => $contactor->id]) ?>"
                                   title="" class="contractor-block-avatar__btn _inviteToTender"
                                   data-click="modal" data-item="#inviteToTenderWindow">ПРИГЛАСИТЬ НА
                                    ТЕНДЕР
                                </a>
                            <?php } ?>
                        </div>
                        <div class="contractor-block-info">
                            <div class="contractor-block-info__name">
                                <a href="<?=\yii\helpers\Url::to(['/exchange/contractor/view','id'=>$contactor->id, 'specialization' => $specializationModel->alias])?>"> <?= $contactor->title ?>
                                </a>
                            </div>
							<div class="contractor-block-info__contact contractor-block-info__contact--city">
							 Города: <?= $contactor->profile->getCityListString() ?>
							</div>
                            <div class="contractor-block-info__service">Предлагаемые услуги
                                <a href="#" title="" data-show="<?= $contactor->profile->specializationsString ?>" class="contractor-block-info-show">
                                    показать
                                </a>
                            </div>
                            <?=\app\modules\cms\widgets\Rate::widget(['model'=>$contactor,'primaryKey'=>$contactor->id])?>
                            <div class="portfolio-album__count">Фото<span><?=$contactor->photoCount?></span></div>
                            <div class="contractor-block-images">
                                <?php foreach(\app\modules\exchange\models\Album::getAllImagesByUser($contactor->id,6) as $image):?>
                                <a href="<?=\yii\helpers\Url::to(['/exchange/contractor/view','id'=>$contactor->id])?>" title="">
                                    <img src="<?=$image->imageSrc('95x76',\alexBond\thumbler\Thumbler::METHOD_CROP_CENTER)?>" alt="">
                                </a>
                                <?php endforeach?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach?>

                    <?php
                    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>