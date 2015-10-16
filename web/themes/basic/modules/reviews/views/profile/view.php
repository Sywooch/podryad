<?php
/* @var $this \yii\web\View */
/* @var $model \app\modules\reviews\models\Profile */
/* @var $reviewsModel \app\modules\reviews\models\Reviews */
/* @var $reviewsList \app\modules\reviews\models\Reviews[] */
$this->title = $model->fio;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;
$this->registerJsFile('//vk.com/js/api/openapi.js?116',['position'=>\yii\web\View::POS_HEAD]);
?>


<?=$this->render('@app/modules/reviews/views/profile/_user.php',['model'=>$model,'isView'=>true,'subscribeModel'=>$subscribeModel])?>

<div class="panel panel-default">
    <div class="panel-body">
        <?php $form = ActiveForm::begin()?>
        <?=$form->field($reviewsModel,'otziv')->textInput()?>
        <div class="pull-right">
            <?=Html::submitButton('Оставить отзыв',['class'=>'btn btn-primary'])?>
        </div>
        <?php ActiveForm::end()?>
    </div>
</div>

<?php if($reviewsList):?>
<div class="row">
    <div class="col-md-12">
        <?php foreach($reviewsList as $reviews):?>
            <div class="row _review" data-id="<?=$reviews->id?>">
                <div class="col-md-1">
                    <i class="glyphicon glyphicon-user" style="font-size: 3em"></i>
                </div>
                <div class="col-md-8">
                    <p>
                        <?=Html::encode($reviews->otziv)?>
                    <p>
                        <small><?=Yii::$app->formatter->asDatetime(strtotime($reviews->data))?></small>
                    </p>
                </div>
                <div class="col-md-3">
                    <div class="pull-right">
                        <a href="#" class="btn btn-default btn-xs review-like" data-id="<?=$reviews->id?>" data-type="like">
                            <i class="glyphicon glyphicon-thumbs-up" style="font-size:1.3em"></i>
                            <span class="badge count"><?=$reviews->like?></span>
                        </a>
                        <a href="#" class="btn btn-default btn-xs review-like" data-id="<?=$reviews->id?>" data-type="dislike">
                            <i class="glyphicon glyphicon-thumbs-down" style="font-size:1.3em"></i>
                            <span class="badge count"><?=$reviews->dislike?></span>
                        </a>
                        <a href="#" class="_reviewRemove btn btn-xs btn-default">
                            <i class="glyphicon glyphicon-remove-circle"></i>
                            Скрыть
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach?>
    </div>
</div>
<?php endif?>

<?php
Modal::begin([
    'id'=>'social-share',
    'header' => '<h4>Инструкция:</h4>',
]);
?>
    <p>Для того чтобы скрыть отзыв, вам нужно поделится страницей у себя на стене. Для этого вам нужно нажать на "Мне нравится"</p>
    <p>Далее нажать на "Рассказать друзьям"</p>
    <div id="vk_like"></div>
<?php Modal::end()?>