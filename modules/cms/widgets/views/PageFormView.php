<?php
/* @var $model Page */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\modules\cms\models\Page;
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'visible')->checkbox() ?>

    <?= $form->field($model, 'parentId')->dropDownList($model->dropDown(Page::DIR),['prompt'=>'---']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'metaKeywords')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'metaDescription')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'dateCreate')->textInput() ?>

    <?= $form->field($model, 'systemName')->textInput(['maxlength' => 255]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>