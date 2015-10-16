<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\User */
/* @var $profile app\modules\cms\models\Profile */
    /* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">

        <?php echo $form->field($model,'role')->dropDownList($model->getRolesDropdown(),['prompt'=>'---']);?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Персональные данные пользователя
            </div>
            <div class="panel-body">
                <?= $form->field($profile, 'name')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($profile, 'phone')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($profile, 'specialization')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($profile, 'post')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($profile, 'work')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($profile, 'cityId')->dropDownList(\app\modules\cms\models\City::dropDown()) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?php if($model->isNewRecord):?>
            <?=Html::submitButton('Добавить и выслать данные на почту',['class'=>'btn btn-primary','name'=>'createAndNotice'])?>
        <?php endif?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Редактировать'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
