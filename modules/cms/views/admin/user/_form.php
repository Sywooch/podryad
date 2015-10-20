<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\User */
/* @var $profile app\modules\cms\models\Profile */
    /* @var $form yii\widgets\ActiveForm */
$cityModel = \app\modules\cms\models\Reference::findOne(['alias'=>'cityList']);
$cityList = \yii\helpers\ArrayHelper::map($cityModel->children(),'id','title');
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
                <?= $form->field($profile, 'fio')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($profile, 'company')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($profile, 'phone')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($profile, 'cityId')->dropDownList($cityList) ?>
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
