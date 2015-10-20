<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 02.10.15
 * Time: 10:42
 * @var $model \app\modules\cms\models\form\RegisterForm
 */
use yii\widgets\ActiveForm;

$cityList = \app\modules\cms\models\Reference::findOne(['alias' => 'cityList'])->children();
$cityDropdown = \yii\helpers\ArrayHelper::map($cityList, 'id', 'title');
?>
<div id="registration-customer" class="modal registration-customer">
    <div class="modal__close">x</div>
    <div class="modal__title">Регистрация заказчика</div>
        <?php $form = ActiveForm::begin([
            'id'=>'user-register-customer',
            'action'=>['/cms/users/register','scenario'=>\app\modules\cms\models\User::ROLE_CUSTOMER],
            'validationUrl'=>['/cms/users/register-validate','scenario'=>\app\modules\cms\models\User::ROLE_CUSTOMER],
            'options'=>[
                'class'=>'form'
            ],
            'enableAjaxValidation'=>true,
        ])?>
        <?=$form->field($model,'fio')?>
        <?=$form->field($model,'company')?>
        <?=$form->field($model,'username')?>
        <?=$form->field($model,'cityId')->dropDownList($cityDropdown)?>
        <?=$form->field($model,'phone')?>
        <?=$form->field($model,'password')->passwordInput()?>
        <?=$form->field($model,'password2')->passwordInput()?>
        <?=$form->field($model,'agree')->checkbox(['label'=>'Я согласен с условиями пользования сервисом'])?>
        <input type="submit" value="Зарегистрироваться" class="form__submit">
    <?php ActiveForm::end()?>
</div>