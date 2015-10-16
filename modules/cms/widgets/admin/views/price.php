<?php
/**
 * @var $this \yii\base\Widget
 * @var $model \app\modules\cms\models\Price
 * @var $form ActiveForm
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin([
   'enableAjaxValidation'=>true,
    'action'=>['/cms/admin/price'],
]);?>
<?=Html::activeHiddenInput($model,'object',['value'=>$model->object])?>
<?=Html::activeHiddenInput($model,'objectId',['value'=>$model->objectId])?>
<?=$form->field($model,'title')->textInput()?>
<?=$form->field($model,'price')->textInput()?>
<?=Html::submitButton('Сохранить',['class'=>'btn btn-primary'])?>