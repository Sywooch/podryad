<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\exchange\models\Tender
 * @var $list \app\modules\exchange\models\Tender[]
 * @var $pages \yii\data\Pagination
 */

use yii\helpers\Html;
use app\modules\cms\models\Settings;

$this->registerJsFile(
    $this->theme->getUrl('static/js/scrollSave.js'),
    ['depends' => \yii\web\JqueryAsset::className()]
);

$title = Settings::get('tender','metaTitle');
$this->title = $title ? $title : 'Тендеры';
$h1 = Settings::get('tender', 'h1');
$this->registerMetaTag(['name' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['name' => 'og:description', 'content' => Settings::get('tender', 'metaDescription')]);
$this->registerMetaTag(['name' => 'twitter:description', 'content' => Settings::get('tender', 'metaDescription')]);
$this->registerMetaTag(['name'=>'keywords','content'=>Settings::get('tender','metaKeywords')]);
$this->registerMetaTag(['name'=>'description','content'=>Settings::get('tender','metaDescription')]);
$this->params['breadcrumbs'] = [
    $h1
];
?>
<main class="main">
    <section class="search-contractor-content">
        <h1 class="search-contractor-content__title"><?=$h1?></h1>
            <?=\app\modules\exchange\widgets\SpecializationFilter::widget(['checked'=>$model->specializationIds,'priceUse'=>true,'filterModel' => 'Tender'])?>
        <div class="search-contractor-results">
            <?php if( \Yii::$app->user->isGuest || \Yii::$app->user->can(\app\modules\cms\models\User::ROLE_CUSTOMER)):?>
            <div class="announce-tender">
                <div class="announce-tender__baner"><img src="<?=$this->theme->getUrl('static/images/general/stepspodryad.gif')?>" alt="">
                </div>
                <?=Html::beginForm(['create'],'post',[
                    'class'=>'announce-tender-form',
                    'validateUrl'=>['index'],
                ])?>
                <?=Html::errorSummary($model)?>
                    <?=Html::activeTextInput($model,'title',['placeholder'=>'Укажите название (Например: Нужно сделать теплые полы 80 кв.м.)','class'=>'announce-tender-form__input'])?>
                    <?=Html::activeTextarea($model,'description',['class'=>'announce-tender-form__input announce-tender-form__input--textarea','placeholder'=>'Перечень работ (опишите максимально подробно: перечень работ, площадь помещений, сроки выполнения, требования к подрядчикам и т. д.)'])?>
                    <div class="btn btn--tender">
                        <input type="submit" value="Объявить тендер" class="announce-tender-form__submit">
                    </div>
                <?=Html::endForm()?>
            </div>
            <?php endif?>

            <?php if(!$list):?>
                <p>Нет информации</p>
            <?php endif?>

            <?php foreach($list as $row):?>
            <div class="search-contractor-results-list">
                <div class="search-contractor-results-list-item">
                    <div class="contractor-block tenders">
                        <div class="contractor-block-avatar">
						<a href="<?=$row->url?>">	
						<img src="<?=$row->user->profile->imageSrc('197x125')?>" alt="">
						</a>
                            <div class="tenders__name"><?=$row->user->title?>
							
							</div>
                        </div>
                        <div class="contractor-block-info">
                            <div class="contractor-block-info__name">
                                <a href="<?=$row->url?>"><?=Html::encode($row->title)?></a>
								 <a href="<?=\yii\helpers\Url::to(['/exchange/tender/view','id'=>$row->id])?>" title="" class="accaunt_tender_item_btn tender_status">Тендер <?=$row->statusTitle?></a>
                            </div>
                            <div class="tenders__text">Города: <?=$row->user->profile->getCityListString()?></div>
                            <div class="tenders__text"><?=$row->specializationsString?></div>
                            <div class="tenders__text">
                                Предложений: <?=$row->offersCount?>
                            </div>
                            <div class="tenders__text"><?=Html::encode($row->description)?>
                            </div>
                            <div class="tenders-info">
                            <div class="tenders-info__time"><span>Тендер открыт:	     </span><?=$row->date?>
                                </div>
                                <div class="tenders-info__budget">Бюджет: <span><?=$row->priceString?></span></div>
                            </div>
                        </div>
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
    </section>
</main>
