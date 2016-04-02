<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\exchange\models\Tender */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tender-form">
    <?=Html::errorSummary($model)?>
    <?php $form = ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data',
        ]
    ]); ?>



    <div class="row">
        <div class="col-md-8">
            <div class="well">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 300]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'h1')->textInput() ?>
            <?= $form->field($model, 'metaTitle')->textInput() ?>
            <?= $form->field($model, 'metaKeywords')->textInput() ?>
            <?= $form->field($model, 'metaDescription')->textarea() ?>
            </div>

        </div>

        <div class="col-md-4">
            <div class="well">

                <p>
                    Логин: <?=$model->user->username?> <br/>
                    Имя: <?=$model->user->profile->fio?> <br/>
                    Компания: <?=$model->user->profile->company?>
                </p>

                <?= $form->field($model, 'active')->dropDownList(\app\modules\exchange\models\Tender::statusDropdown()) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => 32, 'readonly' => true]) ?>

                <?= $form->field($model, 'dateCreate')->textInput(['readonly'=>true]) ?>


            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
