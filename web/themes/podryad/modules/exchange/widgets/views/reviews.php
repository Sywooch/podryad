<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 15.10.15
 * Time: 17:53
 * @var $reviewsList \app\modules\exchange\models\Reviews[]
 * @var $model \app\modules\exchange\models\Reviews
 * @var $contractorId integer
 */
?>
<div class="contractor-tabs-reviews">
    <?php if($reviewsList):?>
    <?php foreach($reviewsList as $reviews):
    list($date,$time) = explode(' ',\Yii::$app->formatter->asDatetime(strtotime($reviews->dateCreate)));
    ?>
    <div class="contractor-tabs-reviews-item">
        <div class="contractor-tabs-reviews-item__img">
            <img src="<?=$reviews->user->profile->imageSrc('172x123')?>" alt=""></div>
        <div class="contractor-tabs-reviews-item__content">
            <div class="contractor-tabs-reviews-item__name"><?=$reviews->user->profile->fio?> </div>
            <div
                class="contractor-tabs-reviews-item__rating contractor-tabs-reviews-item__rating--<?=$reviews->ratingCssClass?>"></div>
            <div class="contractor-tabs-reviews-item__date">
                <?=$date?>
                <span><?=$time?></span>
            </div>
            <div class="contractor-tabs-reviews-item__text">
                <p>
                    <?=strip_tags($reviews->content)?>
                </p>
            </div>
        </div>
    </div>
    <?php endforeach?>
    <?php else:?>
        <p>У подрядчика еще нет отзывов</p>
    <?php endif?>

    <?php if(!\Yii::$app->user->isGuest && \Yii::$app->user->identity->role == \app\modules\cms\models\User::ROLE_CUSTOMER):?>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action'=>['/exchange/reviews/create'],
            'enableAjaxValidation'=>true,
        ])?>
        <?=\yii\helpers\Html::activeHiddenInput($model,'contractorId')?>
        <?=$form->field($model,'rate')->radioList(['Дислайк','Лайк',['class'=>'like_rev dislike_rev'])?>
        <?=$form->field($model,'content')->textarea()?>
        <?=\yii\helpers\Html::submitButton('Добавить')?>
        <?php \yii\widgets\ActiveForm::end()?>
    <?php endif?>
</div>