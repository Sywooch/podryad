<?php
/* @var $model \app\modules\reviews\models\Profile */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
?>
<?php if(isset($model)):?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-3">
                    <?=Html::a(Html::encode($model->fio),['/reviews/profile/view','id'=>$model->id])?>
                </div>
                <div class="col-md-2">
                    <?php
                    if(isset($isView)){
                        Modal::begin([
                            'header' => '<h4>Подписка на новые отзывы:</h4>',
                            'toggleButton' => ['label' => 'Подписаться на отзывы','class'=>'btn btn-primary btn-sm'],
                        ]);

                        $form = ActiveForm::begin([
                            'id' => 'subscribe-form',
                            'enableAjaxValidation' => true,
                        ]);
                        echo Html::activeHiddenInput($subscribeModel,'profileId',['value'=>$model->id]);
                        echo $form->field($subscribeModel,'email');
                        echo Html::submitButton('Подписаться',['class'=>'btn btn-success']);
                        ActiveForm::end();

                        Modal::end();
                    }
                    ?>
                </div>
                <div class="col-md-7">
                    <div class="pull-right">
                        <?=\Yii::t(
                            'app',
                            '{n, plural,one{# год} few{# года} many{# лет} other{# лет}}',
                            ['n' => $model->vozrast]
                        );?>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-md-2">
                    <img src="<?=$model->thumb('160x160')?>" alt="ivphpan" class="img-thumbnail">
                </div>

                <div class="col-md-10">
                    <?=nl2br(Html::encode($model->informaciya))?>
                </div>

            </div>

        </div>
        <div class="panel-footer">
            <?php if(isset($isView)):?>
            <div class="pull-left">
                <?=Yii::$app->params['pluso']?>
            </div>
            <?php endif;?>
            <div class="pull-right">
                <a href="#" class="btn btn-primary">
                    Просмотров <span class="badge"><?=$model->visitors?></span>
                </a>
                <a href="#" class="btn btn-success">
                    Отзывов <span class="badge"><?=$model->reviewsCount()?></span>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php else:?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="pull-left">Водянов Иван Александрович</div>
            <div class="pull-right">27 лет</div>
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-md-2">
                    <img src="<?= Url::base() ?>/uploads/profile/1.jpg" alt="ivphpan" class="img-thumbnail">
                </div>

                <div class="col-md-10">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, quasi dignissimos magni hic corporis exercitationem delectus atque labore quo optio rem enim beatae velit consequuntur in quaerat ex fugit tempora.</p>
                </div>

            </div>

        </div>

        <div class="panel-footer">
            <div class="pull-right">
                <a class="btn btn-default btn-xs">
                    Лайков <i class="badge">2015</i>
                </a>
                <a class="btn btn-default btn-xs">
                    Лайков <i class="badge">2015</i>
                </a>
                <a class="btn btn-default btn-xs">
                    Репостов <i class="badge">2015</i>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
<?php endif?>


