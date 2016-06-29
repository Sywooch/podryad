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

$this->registerJsFile(
    $this->theme->getUrl('static/js/scroll/save.js'),
    ['depends'=>\yii\web\JqueryAsset::className()]
);

$title = \app\modules\cms\models\Settings::get('contractor','listTitle-'.$specializationModel->alias);
$metaDescription = \app\modules\cms\models\Settings::get('contractor','metaDescription-'.$specializationModel->alias);
$metaKeywords = \app\modules\cms\models\Settings::get('contractor','metaKeywords-'.$specializationModel->alias);
$this->title = $title;
if($specializationModel)
{
    $this->registerMetaTag(['name' => 'og:title', 'content' => $title]);
    $this->registerMetaTag(['name' => 'og:description', 'content' => $metaDescription]);
    $this->registerMetaTag(['name' => 'twitter:description', 'content' => $metaDescription]);
    $this->registerMetaTag(['name'=>'keywords','content'=> $metaKeywords]);
    $this->registerMetaTag(['name'=>'description','content'=> $metaDescription]);
}
$breadcrumbs = [];
if($specializationModel->alias != 'specializacii')
{
    $breadcrumbs=[
        ['label' => 'Подрядчики','url'=>['/exchange/contractor']],
        $specializationModel->title
    ];
}else
{
    $breadcrumbs = [
      'Подрядчики'
    ];
}
$h1 = $specializationModel->alias =='specializacii' ? 'Подрядчики' : $specializationModel->title;
$this->params['breadcrumbs'] = $breadcrumbs;
?>
<main class="main">
    <section class="search-contractor-content">
        <h1 class="search-contractor-content__title"><?=$h1?></h1>
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
                            <a href="<?= \yii\helpers\Url::to(['/exchange/contractor/view', 'id' => $contactor->id]) ?>"><img src="<?=$contactor->profile->imageSrc('199x159')?>" alt="">
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
                                <a href="<?=\yii\helpers\Url::to(['/exchange/contractor/view','id'=>$contactor->id])?>"> <?= $contactor->title ?>
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
                            <?//=\app\modules\cms\widgets\Rate::widget(['model'=>$contactor,'primaryKey'=>$contactor->id])?>
                            <div class="portfolio-album__count">Фото<span><?=$contactor->profile->getImages()->count()?></span></div>
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
/*                    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                    */?>
                </div>
            </div>
        </div>
    </section>
</main>
