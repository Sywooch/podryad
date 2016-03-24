<?php
/** @var $this \yii\web\View */
/** @var $model \app\modules\exchange\models\forms\TenderSettings */

$this->title = 'Общие настройки';
?>
<div class="well">
    <?php $form = \yii\widgets\ActiveForm::begin() ?>
    <div class="row">
        <div class="col-md-6">
            <?=$form->field($model,'metaKeywords')->textarea()?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'metaDescription')->textarea() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'newsMetaKeywords')->textarea() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'newsMetaDescription')->textarea() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= \yii\bootstrap\Html::submitButton('сохранить', ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?php \yii\widgets\ActiveForm::end() ?>
</div>
