<?php
/* @var $model \app\modules\discount\models\Card */
/* @var $this \yii\web\View */
$this->title = 'Карта: '.$model->cvcode;
?>

<div class="b-card-container">

    <?php if($model->status == \app\modules\discount\models\Card::STATUS_PRINT):?>
        <?=\yii\helpers\Html::a('Активировать',['/discount/default/activate','cvcode'=>$model->cvcode],['class'=>'btn btn-primary btn-block'])?>
    <?php endif?>

    <?php if($model->status == \app\modules\discount\models\Card::STATUS_MODER):?>
        <div class="alert alert-warning">
            Данная карта находится на модерации.
        </div>
    <?php endif?>

    <div class="row-fluid">

        <?php if( ($user=$model->user) ):?>
            <div class="col-md-6">

                <div class="panel panel-yellow  b-profile-card">
                    <div class="panel-heading b-profile-card__header">
                        Персональные данные:
                    </div>
                    <div class="panel-body">

                        <div class="col-md-4 col-xs-4">
                            <img src="<?=$model->user->profile->photo('150x150')?>" alt=""/>
                        </div>

                        <div class="col-md-8 col-xs-4 b-profile-card__info">

                            <dl>
                                <dt>Город:</dt>
                                <dd><?=$user->profile->city->title?></dd>

                                <dt>Ф.И.О</dt>
                                <dd><?=$user->profile->name?></dd>

                                <dt>Телефон:</dt>
                                <dd><?=$user->profile->phone?></dd>
                            </dl>

                        </div>

                    </div>
                    <?php
                    /*
                    <div class="panel-footer">
                        
                         if($model->userId == \Yii::$app->user->id):?>
                            <a href="" class="btn btn-block b-profile-card__button">Редактировать данные</a>
                        <?php endif?>
                    </div>*/
                        ?>
                </div>

            </div>
        <?php endif?>

        <?php if(\Yii::$app->user->can('partner') && ($services = \app\modules\discount\models\Service::findByUserId(Yii::$app->user->id)) && $model->status == \app\modules\discount\models\Card::STATUS_ACTIVE):?>
        <div class="col-md-6">

            <div class="panel panel-success">
                <div class="panel-heading">
                    Выбор услуги:
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive table-bordered">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название услуги</th>
                                <th>Скидка</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($services as $service):?>
                            <tr>
                                <td>1</td>
                                <td><?=$service->title?></td>
                                <td><?=$service->discount?>%</td>
                                <td>
                                    <?php $form = \yii\widgets\ActiveForm::begin(['action'=>['/discount/default/use']])?>
                                    <?=\yii\helpers\Html::activeHiddenInput($history,'serviceId',['value'=>$service->id])?>
                                    <?=\yii\helpers\Html::activeHiddenInput($history,'userId',['value'=>$model->userId])?>
                                    <?=\yii\helpers\Html::submitButton('<i class="fa fa-check"></i> Использовать',['class'=>'btn btn-success btn-sm'])?>
                                    <?php \yii\widgets\ActiveForm::end()?>
                                </td>
                            </tr>
                            <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>


        </div>
        <?php endif?>
    </div>

</div>

<style>
    .b-profile-card{

    }

    .b-profile-card__header{
        font-size: 24px;
    }

    .b-profile-card__image{

    }

    .b-profile-card__info{
    }

    .b-profile-card__info dt{
        font-size: 20px;
    }

    .b-profile-card__info dd{
        margin-bottom: 10px;
        font-size: 16px;
    }
</style>