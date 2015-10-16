<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $form \app\modules\discount\models\Card */

$this->title = 'Активация карты';
?>
<div class="row-fluid">
<div class="well col-md-4">
    
    <?php $form = ActiveForm::begin()?>
    <?=$form->field($model,'cvcode')->textInput()?>
    <?=  Html::submitButton('Активировать',['class'=>'btn btn-success'])?>
    <?php ActiveForm::end()?>
</div>
    </div>