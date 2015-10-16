<?php
/* @var $model \app\modules\discount\models\Card */
/* @var $user \app\modules\cms\models\User */
/* @var $profile \app\modules\cms\models\Profile */
/* @var $this \yii\web\View */
$this->title = 'Активация карты: ' . $model->cvcode;
?>

<div class="row-fluid">
    <?php $form = \yii\bootstrap\ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]) ?>
    <div class="col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                Данные для авторизации:
            </div>
            <div class="panel-body">

                <?= $form->field($user, 'username')->textInput() ?>

                <?= $form->field($user, 'password')->passwordInput() ?>

                <?= $form->field($user, 'password2')->passwordInput() ?>


            </div>
            <div class="panel-footer">
                <p>
                    Эти данные будут использоваться в дальнейшем для авторизации в личном кабинете.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                Персональные данные:
            </div>
            <div class="panel-body">

                <?= $form->field($profile, 'cityId')->dropDownList(\app\modules\cms\models\City::dropDown()) ?>

                <?= $form->field($profile, 'name')->textInput() ?>

                <?= $form->field($profile, 'phone')->textInput() ?>

                <?= $form->field($profile, 'file')->fileInput() ?>

            </div>
            <div class="panel-footer">
                * поля обязательные для заполнения
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                Укажите email человека, от которого вы о нас узнали:
            </div>
            <div class="panel-body">

                <?= $form->field($partner, 'email')->textInput() ?>

            </div>
            <div class="panel-footer">
                * поля обязательные для заполнения
            </div>
        </div>
    </div>
    <?=\yii\helpers\Html::submitButton('Регистрация',['class'=>'btn btn-block btn-success'])?>
    <?php \yii\bootstrap\ActiveForm::end() ?>

</div>