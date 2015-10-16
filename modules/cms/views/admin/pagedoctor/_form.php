<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\PageDoctor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-doctor-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'doctorId')->dropDownList(\app\modules\directorBoard\models\Board::personalList()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
