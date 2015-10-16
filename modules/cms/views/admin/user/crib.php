<?php

/* @var $model \app\modules\cms\models\User */
/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = 'Списание средств';
?>
<div class="row-fluid">
    <div class="col-md-6">
        <h4>Данные пользователя:</h4>
        <div class="well well-sm">
            <p><strong>Логин:</strong> <?=$model->username?></p>
            <p><strong>Баланс:</strong> <?=$model->profile->balance?></p>
            <?php $form = ActiveForm::begin()?>
            <?=$form->field($model,'crib')?>
            <?=  Html::submitButton('Списать')?>
            <?php ActiveForm::end()?>
        </div>
    </div>
</div>