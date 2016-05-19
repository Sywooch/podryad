<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\exchange\models\Projecthouse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projecthouse-form">

    <div class="panel panel-default">
        <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'options'=>['enctype'=>'multipart/form-data']
            ]); ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<!--                    --><?//= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'file')->fileInput() ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                </div>


                <div class="col-md-6">
                    <?= $form->field($model, 'yandexDisk')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'googleDisk')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'skyDrive')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
