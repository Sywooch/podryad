<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>

<main class="main">
    <section class="news-content">
        <div class="beseda">
            <div class="item_title">
                <h1><?= $this->title ?></h1>
            </div>
            <div class="form_vxod">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'options' => [
                            'class' => 'form_input'
                        ]
                    ],
                ]); ?>
                <?= $form->field($model, 'username')->textInput() ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox(['checked'=>'checked']) ?>

                <div class="form_button_vxod">
                    <button> Войти</button>
                </div>
                <div class="register">
                    <a href="<?=\yii\helpers\Url::to(['/cms/users/remind'])?>" title="">Восстановление пароля</a>
                </div>
                <div class="register">
                    <a href="#" title="" data-click="modal"
                       data-item="#registration">Регистрация
                    </a>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </section>
    <?=$this->render('//layouts/_sidebar')?>
</main>