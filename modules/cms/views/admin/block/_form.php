<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Block */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="block-form">

    <div class="well">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'alias')->textInput(['maxlength' => 64, 'placeholder' => 'на английском языке']) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

        <?= $form->field($model, 'content')->widget(\app\assets\Redactor::className()) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>


</div>
