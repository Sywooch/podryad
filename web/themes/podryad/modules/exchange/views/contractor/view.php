<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 06.10.15
 * Time: 13:38
 * @var $this \yii\web\View
 * @var $model \app\modules\exchange\models\Contactor
 * @var $priceList \app\modules\exchange\models\ContractorPrice[]
 * @var $workTenderList \app\modules\exchange\models\Tender[]
 * @var $specializationModel \app\modules\cms\models\Reference
 */
use yii\helpers\Url;
$this->title = $model->profile->metaTitle ? $model->profile->metaTitle : $model->getTitle();

$albumList = \app\modules\exchange\models\Album::getAllByUser($model->id);
$previous = Url::previous('contractor') ? Url::previous('contractor') : Url::to(['/exchange/contractor']);
$metaTitle = $model->profile->metaTitle;
$metaDescription = $model->profile->metaDescription;
$metaKeywords = $model->profile->metaKeywords;

$this->registerMetaTag(['name' => 'og:title', 'content' => $metaTitle]);
$this->registerMetaTag(['name' => 'og:description', 'content' => $metaDescription]);
$this->registerMetaTag(['name' => 'twitter:description', 'content' => $metaDescription]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $metaKeywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $metaDescription]);

$this->params['breadcrumbs'][] =  ['label' => 'Подрядчики', 'url' => ['/exchange/contractor']];
if($specializationModel)
{
    $this->params['breadcrumbs'][]=['label'=>$specializationModel->title,'url'=>['/exchange/contractor/index','specialization'=>$specializationModel->alias]];
}
$this->params['breadcrumbs'][]=$this->title;

$phones = [$model->profile->phone];
if($model->profile->phone2)
    $phones[]= $model->profile->phone2;
if($model->profile->phone3)
    $phones[] = $model->profile->phone3;
?>
<main class="main">
    <section class="contractor-content">
        <a href="<?=$previous?>" title="" class="contractor-back">Вернуться к списку подрядчиков</a>
        <div class="contractor-block">
            <div class="contractor-block-avatar">
                <img src="<?=$model->profile->imageSrc('197x125')?>" alt="">
                <?php if (\Yii::$app->user->isGuest){ ?>
                    <a href="#" title="" class="contractor-block-avatar__btn _contractor" data-click="modal" data-item="#enter">ПРИГЛАСИТЬ НА ТЕНДЕР</a>
                <?php }elseif(\Yii::$app->user->can(\app\modules\cms\models\User::ROLE_CUSTOMER)){?>
                    <a href="<?= \yii\helpers\Url::to(['/exchange/tender/my', 'contractorId' => $model->id]) ?>"
                       title="" class="contractor-block-avatar__btn _inviteToTender"
                       data-click="modal" data-item="#inviteToTenderWindow">ПРИГЛАСИТЬ НА
                        ТЕНДЕР
                    </a>
                <?php }?>
				<?php if ($model->isMine()): ?>
                    <div class="contractor-block-info__contact contractor-block-info__contact--edit podryadchik">
                        <a href="<?= \yii\helpers\Url::to(['/cms/users/update']) ?>" title=""
                           class="contractor-block-info-show-edit">Редактировать профиль
                        </a>
                    </div>
                <?php endif ?>
            </div>
            <div class="contractor-block-info">
                <h1 class="contractor-block-info__name">
                    <?= $model->getTitle(true) ?>
                </h1>
				
				<div class="contractor-block-info__contact contractor-block-info__contact--city">
				 Города: <?= $model->profile->getCityListString() ?>
				</div>
                <div class="contractor-block-info__service">
                    Предлагаемые услуги
                    <a href="#" title="" data-show="<?=$model->profile->specializationsString?>" class="contractor-block-info-show">показать</a>
                </div>
				<div class="info_block contractor">
                <div class="contractor-block-info__contact contractor-block-info__contact--phone">
                    <a href="#" title="" data-show="<?=implode('<br>',$phones)?>" class="contractor-block-info-show">
                        показать номер<?php if($model->profile->phone2) echo 'a'?>
                    </a>
                </div>
                <div class="contractor-block-info__contact contractor-block-info__contact--email">
                    <a href="#" title="" data-show="<?=$model->username?>" class="contractor-block-info-show">показать
                        e-mail
                    </a>
                </div>
		
                <?php if (($site = $model->profile->site)): ?>
                    <div class="contractor-block-info__contact contractor-block-info__contact--site">
                        <a href="" title="" data-show="<?= $site ?>" class="contractor-block-info-show">показать сайт
                        </a>
                    </div>
                <?php endif ?>

                <?php if (($address = $model->profile->adres)): ?>
                    <div class="contractor-block-info__contact contractor-block-info__contact--address">
                        <a href="#" title="" data-show="<?= $address ?>" class="contractor-block-info-show">показать
                            адрес
                        </a>
                    </div>
                <?php endif ?>

                </div>
                <?//= \app\modules\cms\widgets\Rate::widget(['model' => $model, 'primaryKey' => $model->id]) ?>
            </div>
            <div class="contractor-block-images">
                <?php foreach(\app\modules\exchange\models\Album::getAllImagesByUser($model->id,8) as $image):?>
                <a href="<?=$image->resize('1024x768')?>" title="" class="swipebox">
                    <img src="<?=$image->resize('95x76',\alexBond\thumbler\Thumbler::METHOD_CROP_CENTER)?>" alt="">
                </a>
                <?php endforeach?>
            </div>
        </div>
        <div class="contractor-meta">
            <div class="contractor-meta__baner">
                <img src="<?=$this->theme->getUrl('static/images/content/bi_group.gif')?>" alt=""></div>
            <div class="contractor-tabs">
                <div class="contractor-tabs-control">
                    <a href="#" title="" class="contractor-tabs-control__item">Описание</a>
                    <a href="#" title="" class="contractor-tabs-control__item">Отзывы</a>
                    <a href="#" title="" class="contractor-tabs-control__item active">Портфолио</a>
                    <a href="#" title="" class="contractor-tabs-control__item">Цены</a>
                </div>
                <div class="contractor-tabs-box">
                    <div class="contractor-tabs-box__item">
                        <div class="contractor-tabs-description">
                            <?php if($model->isMine()):?>
                                <?php if(empty($model->profile->memo)):?>
                                    <p class="not_des"">Добавьте, пожалуйста, описание про свою компанию или про себя</p>
                                <?php endif?>
                            <?=$this->render('_description',['model'=>$model])?>
                            <?php else:?>
                                <?php if($model->profile->memo):?>
                                    <?=$model->profile->memo?>
                                <?php else:?>
                                        <p class="not_des"">Подрядчик еще не добавил описание</p>
                                <?php endif?>
                            <?php endif?>
                        </div>
                    </div>
                    <div class="contractor-tabs-box__item">
                        <?=\app\modules\exchange\widgets\Reviews::widget(['contractorId'=>$model->id])?>
                    </div>
                    <div class="contractor-tabs-box__item active">
						<?php if ($model->isMine()): ?>
                            <a class="portfolio-album-add" href="<?=Url::to(['/exchange/album/create'])?>">Создать альбом</a>
                            <?php endif ?>
                        <div class="portfolio">

                            

                            <?php if($albumList):?>
                            <div class="portfolio-sliders">
                                <?php foreach($albumList as $k=>$album):?>
                                <div class="portfolio-slider <?=$k == 0 ?'active':''?>">

                                    

                                    <div class="portfolio-slider-big slider-big">
                                        <?php foreach($album->images as $image):?>
                                        <img src="<?=$image->resize('600x428',\alexBond\thumbler\Thumbler::METHOD_CROP_CENTER)?>" alt="">
                                        <?php endforeach?>
                                    </div>
                                    <div class="portfolio-slider-small slider-small">
                                        <?php foreach ($album->images as $image): ?>
                                            <img src="<?= $image->resize('74x60',\alexBond\thumbler\Thumbler::METHOD_CROP_CENTER) ?>" alt="">
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <?php endforeach?>
                            </div>

                            <div class="portfolio-albums">
                                <?php foreach($albumList as $k=>$album):?>
                                <div class="portfolio-album <?=$k == 0 ? 'active' : ''?>">
                                    <img src="<?=$album->imageSrc('161x116')?>" alt=""
                                         class="portfolio-album__preview">

                                    <div class="portfolio-album__title">
                                        <?=$album->title?>
                                        <?php if($model->isMine()){?><?php }?>
                                    </div>
                                    <div class="portfolio-album__count">
                                        Фото
                                        <span><?=$album->imagesCount?></span>
                                    </div>
									<?php if($model->isMine()):?>
                                    <a href="<?=Url::to(['/exchange/album/update','id'=>$album->id])?>" class="album-update">Редактировать альбом</a>
                                    <a href="<?= Url::to(['/exchange/album/delete', 'id' => $album->id]) ?>"
                                       class="album-update" onclick="return confirm('Вы действительно хотите удалить?')">Удалить альбом
                                    </a>
                                    <?php endif?>
                                </div>
                                <?php endforeach?>
                            </div>
                            <?php else:?>

                                <?php if ($model->isMine()): ?>
                                    <div class="not_phote">
                                        <p>Создайте, пожалуйста, альбом и добавьте туда фотографии Ваших работ</p>
                                    </div>
                                <?php else: ?>
                                    <div class="not_phote">
                                        <p>Подрядчик еще не добавил фото</p>
                                    </div>
                                <?php endif ?>

                            <?php endif?>
                        </div>
                    </div>

                    <div class="contractor-tabs-box__item">

                        <?php if($model->isMine()):?>
                        <a class="add_price" href="<?= Url::to(['/exchange/contractor-price/create']) ?>">Добавить</a>
                        <?php endif?>


                        <?php if($priceList):?>
                        <table class="contractor-tabs-cost">
                            <tr>
                                <td>№</td>
                                <td>Название услуги</td>
                                <td>Примерная стоимость</td>
                                <?php if($model->isMine()):?><td></td><?php endif?>
                            </tr>
                            <?php foreach($priceList as $k=>$price):?>
                            <tr>
                                <td><?=$k+1 ?></td>
                                <td><?=$price->title?></td>
                                <td><?=$price->price?> тг.</td>
                                <?php if($model->isMine()):?>
                                <td>
                                    <a class="redak  cena"href="<?=Url::to(['/exchange/contractor-price/update','id'=>$price->id])?>">ред</a> |
                                    <a class="udalit cena"href="<?=Url::to(['/exchange/contractor-price/delete','id'=>$price->id])?>"
                                       onclick="return confirm('Вы действительно хотите удалить?')">удал</a>
                                </td>
                                <?php endif?>
                            </tr>
                            <?php endforeach?>
                        </table>
                        <?php else: ?>
                            <?php if($model->isMine()):?>
                                <div class="not_price">
                                    <p>Добавьте, пожалуйста, цены на Ваши услуги</p>
                                </div>
                            <?php else:?>
                                <div class="not_price">
                                    <p>Подрядчик еще не добавил цены</p>
                                </div>
                            <?php endif?>
                        <?php endif ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
