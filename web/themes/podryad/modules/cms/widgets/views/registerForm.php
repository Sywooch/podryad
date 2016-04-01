<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 02.10.15
 * Time: 10:42
 * @var $model \app\modules\cms\models\form\RegisterForm
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

//$cityList = \app\modules\cms\models\Reference::findOne(['alias' => 'cityList'])->children();
//$cityDropdown = \yii\helpers\ArrayHelper::map($cityList, 'id', 'title');
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
        <?=$form->field($model,'phone')?>
        <label class="registration-contractor-form__label registration-contractor-form__label--required">
            <span>Города</span>

            <div class="registration-contractor-form__row">
                <a href="#" title="" data-click="modal" data-item="#cityList"
                   class="btn city-registration-contractor-form__btn registration-contractor-form__btn">Выбрать города
                </a>
                <em>Максимум 10 городов</em>

                <div class="city-list-selected specialization-list-selected">
                    <?php foreach ($model->cityList as $specialization): ?>
                        <?= Html::activeHiddenInput($model, 'cityList[]', ['value' => $specialization]) ?>
                    <?php endforeach ?>
                </div>
                <?= Html::error($model, 'cityList') ?>
            </div>
        </label>
        <?=$form->field($model,'password')->passwordInput()?>
        <?=$form->field($model,'password2')->passwordInput()?>
        <?=$form->field($model,'agree')->checkbox(['label'=>\yii\helpers\Html::a('Я согласен с условиями пользования сервисом',['/cms/default/page','path'=>'usloviya'],['target'=>'_blank'])])?>
        <input type="submit" value="Зарегистрироваться" class="form__submit">
    <?php ActiveForm::end()?>
</div>
<?= \app\modules\cms\widgets\Specialization::widget(['modelName' => 'RegisterForm', 'alias' => 'cityList', 'template' => 'cityList']) ?>