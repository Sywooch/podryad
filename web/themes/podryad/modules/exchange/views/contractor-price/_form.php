<?php
/** @var $model \app\modules\exchange\models\ContractorPrice */
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin()?>
<?=\yii\helpers\Html::errorSummary($model)?>
<?=$form->field($model,'title')?>
<?=$form->field($model,'price')?>
<?=\yii\helpers\Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать',['class'=>'create-price btn'])?>
<?php ActiveForm::end()?>