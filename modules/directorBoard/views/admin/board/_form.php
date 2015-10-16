<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\directorBoard\models\Board */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="board-form">

    <?php $form = ActiveForm::begin(); ?>
    <br/>
    <!--div class="row">
        <div class="col-md-12">
            <?=$form->field($model,'categoryId')->dropDownList(\app\modules\directorBoard\models\Board::categoryList())?>
        </div>
    </div-->

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => 128]) ?>
        </div>
    </div>

    <?= $form->field($model, 'post')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6])->widget(\app\assets\Redactor::className()) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
