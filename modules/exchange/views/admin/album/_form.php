<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\exchange\models\Album */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="album-form">

    <div class="well">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>


    <?php if($model->isNewRecord == false):?>
    <div class="well">
        <h2>Фотографии</h2>
    <?=\app\modules\cms\widgets\ImageUpload::widget(['model'=>$model,'maxNumberOfFiles'=>100,'primaryKey'=>$model->id])?>
    </div>
    <?php endif?>

</div>
