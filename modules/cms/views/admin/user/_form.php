<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\User */
/* @var $profile app\modules\cms\models\Profile */
    /* @var $form yii\widgets\ActiveForm */

?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Персональные данные пользователя
            </div>
            <div class="panel-body">

                <?php echo $form->field($model, 'role')->dropDownList($model->getRolesDropdown(), ['prompt' => '---']); ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

                <?= $form->field($profile, 'fio')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($profile, 'company')->textInput(['maxlength' => 255]) ?>

                <?= $form->field($profile, 'phone')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($profile, 'phone2')->textInput(['maxlength' => 255]) ?>
                <?= $form->field($profile, 'phone3')->textInput(['maxlength' => 255]) ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Персональные данные пользователя
            </div>
            <div class="panel-body">
                <?=$form->field($profile,'memo')->textarea()?>
                <?= $form->field($profile, 'file')->fileInput() ?>
                <?php

                $profile->cityList = $profile->getCitySelected();
                echo $form->field($profile, 'cityList')->listBox(\app\modules\cms\models\Profile::cityDropdown(),['multiple'=>true]) ?>

                <?= $form->field($profile, 'h1')->textInput() ?>
                <?= $form->field($profile, 'metaTitle')->textInput() ?>
                <?= $form->field($profile, 'metaKeywords')->textInput() ?>

                <?= $form->field($profile, 'metaDescription')->textarea() ?>
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
