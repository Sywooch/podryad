<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\discount\models\Partner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'visible')->radioList(['Скрыт','Виден'])?>

    <div class="col-md-12">
        <?=\app\modules\cms\components\yandexMap\MapInput::widget(['model'=>$model,'attribute'=>'cords'])?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model,'userId')->dropDownList(\app\modules\cms\models\User::getDropDown(),['rows'=>6])?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model,'parentId')->dropDownList($category->dropDown(),['rows'=>6])?>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'site')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'workTime')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phones')->textInput(['maxlength' => 255]) ?>
        </div>
    </div>


    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'metaKeywords')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'metaDescription')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Редактировать'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
