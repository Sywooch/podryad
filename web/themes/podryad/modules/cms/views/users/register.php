<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 30.09.15
 * Time: 11:57
 * @var $this \yii\web\View
 * @var $model \app\modules\cms\models\form\RegisterForm
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Регистрация подрядчика';
$cityList = \app\modules\cms\models\Reference::findOne(['alias' => 'cityList'])->children();
$cityDropdown = \yii\helpers\ArrayHelper::map($cityList,'id','title');
?>

<main class="main">
    <section class="registration-contractor-content">
        <div class="registration-contractor-content__title">Регистрация подрядчика</div>
        <div class="registration-contractor-content__text">Пожалуйста, укажите свои реальные данные, это облегчит
            взаимодействие между вами и заказчиками
        </div>
        <?=Html::errorSummary([$model],['class'=>'registration-contractor-content__text'])?>

            <?= Html::beginForm()?>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Ф.И.О</span>

                <div class="registration-contractor-form__row">
                    <?=Html::activeTextInput($model,'fio',['class'=>'registration-contractor-form__input', 'enableAjaxValidation' => true])?>
                    <?=Html::error($model,'fio')?>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required">
                <span>Компания:</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'company', ['class' => 'registration-contractor-form__input', 'enableAjaxValidation' => true]) ?>
                    <?= Html::error($model, 'company') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Контактный телефон</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'phone', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'phone') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>E-mail</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'username', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'username') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Специализации</span>

                <div class="registration-contractor-form__row">
                    <a href="#" title="" data-click="modal" data-item="#specialization"
                       class="btn registration-contractor-form__btn">Выбрать специализацию
                    </a>
                    <em>Максимум 10 специализаций</em>
                    <div class="specialization-list-selected"></div>
                    <input type="hidden" value="" class="specialization-input-send">
                    <?= Html::error($model, 'specialization') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Где вы готовы работать?</span>

                <div class="registration-contractor-form__row">
                    <?=Html::activeDropDownList($model,'cityId',$cityDropdown,['class'=>'registration-contractor-form__input'])?>
                    <em>Укажите только те города в которых вы готовы работать.</em>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Пароль</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activePasswordInput($model, 'password', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'password') ?>
                    <em>Мы не будем показывать
                        Ваш адрес другим пользователям. Адрес необходим для размещения метки на карте</em>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Повторите пароль</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activePasswordInput($model, 'password2', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'password2') ?><em>Мы не будем показывать
                        Ваш адрес другим пользователям. Адрес необходим для размещения метки на карте</em>
                </div>
            </label>
            <label
                class="registration-contractor-form__label registration-contractor-form__label--license"><span></span>

                <div class="registration-contractor-form__row">
                    <?=Html::activeCheckbox($model,'agree',['label'=>''])?>
                    Я согласен с условиями пользования сервисом
                    <?=Html::error($model,'agree')?>
                </div>
            </label>
            <input type="submit" value="Зарегистрироваться" class="form__submit">
        <?= Html::endForm()?>
    </section>
    <?=$this->render('//layouts/_sidebar')?>
</main>
<?= \app\modules\cms\widgets\Specialization::widget(['modelName'=>'RegisterForm']) ?>