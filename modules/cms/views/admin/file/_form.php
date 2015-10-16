<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\File */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-form">

    <?php $form = ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data',
        ]
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php if(!$model->isNewRecord){?>
        <?php if($model->file):?>
            <p>
                Имеется файл
                <a href="<?=$model->fileLink?>" target="_blank"><?=$model->file?></a>, заменить?
            </p>
        <?php endif;?>
        <?= $form->field($model, 'file')->fileInput(['maxlength' => 128]) ?>
    <?php }?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Редактировать'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
