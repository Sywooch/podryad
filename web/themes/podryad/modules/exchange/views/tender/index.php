<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\exchange\models\Tender
 * @var $list \app\modules\exchange\models\Tender[]
 * @var $pages \yii\data\Pagination
 */
use yii\helpers\Html;
$this->title = 'Тендеры';
?>
<main class="main">
    <section class="search-contractor-content">
        <h1 class="search-contractor-content__title"><?=$this->title?></h1>
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
						<img src="<?=$row->imageSrc('199x159')?>" alt="">
						</a>
                            <div class="tenders__name"><?=$row->user->title?>
							 <a href="<?=\yii\helpers\Url::to(['/exchange/tender/view','id'=>$row->id])?>" title="" class="accaunt_tender_item_btn">Тендер <?=$row->statusTitle?></a>
							</div>
                        </div>
                        <div class="contractor-block-info">
                            <div class="contractor-block-info__name">
                                <a href="<?=$row->url?>"><?=Html::encode($row->title)?></a>
                            </div>
                            <div class="tenders__text">Город: <?=$row->user->profile->city->title?></div>
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