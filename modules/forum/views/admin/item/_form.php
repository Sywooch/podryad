<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">
    <div class="well">
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'authorId')->dropDownList(\app\modules\cms\models\User::getDropDown()) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'alias')->textInput(['maxlength' => 128, 'placeholder' => 'не обязателельно для заполнения']) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'dateCreate')->widget(\yii\jui\DatePicker::className(), ['options' => ['class' => 'form-control']]) ?>
            </div>
        </div>


        <?= $form->field($model, 'description')->widget(\app\assets\Redactor::className()) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
