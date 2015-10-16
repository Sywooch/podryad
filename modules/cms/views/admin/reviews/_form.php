<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviews-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'visible')->checkbox() ?>

    <div class="col-md-4">
        <?= $form->field($model, 'dateCreate')->widget(\yii\jui\DatePicker::className(),[
            'dateFormat' => 'yyyy-MM-dd',
            'options'=>[
                'class'=>'form-control'
            ]
        ]) ?>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'company')->textInput(['maxlength' => 128]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'age')->textInput() ?>
        </div>
    </div>

    <?= $form->field($model, 'content')->textarea() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
