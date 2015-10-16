<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\store\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'statusId')->dropDownList(\app\modules\store\models\Order::statusList()) ?>

            <?= $form->field($model, 'fio')->textInput(['maxlength' => 128,'readonly'=>true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => 23,'readonly'=>true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => 64,'readonly'=>true]) ?>

            <?= $form->field($model, 'dateCreate')->textInput(['maxlength' => 64,'readonly'=>true]) ?>
        </div>
        <div class="col-md-6">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Товары:
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tfoot>
                        <tr>
                            <td colspan="3">
                                <div class="pull-right">
                                    Всего: <?=$model->totalCount()?> шт.
                                </div>
                            </td>
                        </tr>
                        </tfoot>
                        <thead>
                        <tr>
                            <td></td>
                            <td>Наименование</td>
                            <td>Цена</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($model->items as $item):?>
                        <tr>
                            <td><?=Html::img($item->product->image->resize('75x75'))?></td>
                            <td><?=$item->product->title?></td>
                            <td><?=$item->quantity?> шт.</td>
                        </tr>
                        <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Редактировать'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
