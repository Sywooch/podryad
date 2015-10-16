<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\store\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'visible')->checkbox() ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'categoryId')->dropDownList(\app\modules\store\models\Category::dropDown(),['prompt'=>'Выбор']) ?>
        </div>
<!--        <div class="col-md-6">-->
<!--            --><?//= $form->field($model, 'manufacturerId')->dropDownList(\app\modules\store\models\Manufacturer::dropDown(),['prompt'=>'Выбор']) ?>
<!--        </div>-->
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => 128]) ?>
        </div>
    </div>

    <!--div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'minCount')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'quantity')->textInput() ?>
        </div>
    </div -->

    <?= $form->field($model, 'content')->widget(\app\assets\Redactor::className()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
