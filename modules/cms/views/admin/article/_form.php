<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">
    <div class="well">
        <?php $form = ActiveForm::begin(); ?>


        <div class="row">
            <div class="col-md-1">
                <?= $form->field($model, 'visible')->checkbox(['label' => 'Активен']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'type')->dropDownList(\app\modules\cms\models\Article::typeList(), ['prompt' => 'Выбор']) ?>
            </div>
            <div class="col-md-5">
                <?= $form->field($model, 'dateCreate')->widget(
                    \yii\jui\DatePicker::className(),
                    [
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => [
                            'class' => 'form-control'
                        ]
                    ]
                ) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'alias')->textInput(['maxlength' => 128]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'metaKeywords')->textarea() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'metaDescription')->textarea() ?>
            </div>
        </div>


        <?= $form->field($model, 'description')->widget(\app\assets\Redactor::className()) ?>


        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Редактировать'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
