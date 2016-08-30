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
$cityList = \app\modules\cms\models\Reference::getCityList();
$cityDropdown = \yii\helpers\ArrayHelper::map($cityList, 'id', 'title');
?>

<main class="main">
    <section class="registration-contractor-content">
        <div class="registration-contractor-content__title">Регистрация подрядчика</div>
        <div class="registration-contractor-content__text">Пожалуйста, укажите свои реальные данные, это облегчит
            взаимодействие между вами и заказчиками
        </div>
        <?= Html::errorSummary([$model], ['class' => 'registration-contractor-content__text']) ?>

        <?= Html::beginForm('', 'post', ['enctype' => 'multipart/form-data']) ?>
        <label class="registration-contractor-form__label registration-contractor-form__label--required">
            <span>Ф.И.О.</span>

            <div class="registration-contractor-form__row">
                <?= Html::activeTextInput($model, 'fio',
                    ['class' => 'registration-contractor-form__input', 'enableAjaxValidation' => true]) ?>
                <?= Html::error($model, 'fio') ?>
            </div>
        </label>
        <label class="registration-contractor-form__label">
            <span>Компания</span>

            <div class="registration-contractor-form__row">
                <?= Html::activeTextInput($model, 'company',
                    ['class' => 'registration-contractor-form__input', 'enableAjaxValidation' => true]) ?>
                <?= Html::error($model, 'company') ?>
            </div>
        </label>
        <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Контактный телефон</span>

            <div class="registration-contractor-form__row">
                <?= Html::activeTextInput($model, 'phone', ['class' => 'registration-contractor-form__input']) ?>
                <?= Html::error($model, 'phone') ?>
            </div>
        </label>
        <label class="registration-contractor-form__label"> <span>Допллнительные телефоны</span>

            <div class="registration-contractor-form__row">
                <?= Html::activeTextInput($model, 'phone2', ['class' => 'registration-contractor-form__input']) ?>
                <?= Html::error($model, 'phone2') ?>
            </div>
            <div class="registration-contractor-form__row nolabel">
                <?= Html::activeTextInput($model, 'phone3', ['class' => 'registration-contractor-form__input']) ?>
                <?= Html::error($model, 'phone3') ?>
            </div>
        </label>
        <label class="registration-contractor-form__label"> <span>Ваш логотип или фото</span>

            <div class="registration-contractor-form__row">
                <div class="type_file">
                    <div class="form-group field-reviews-file">
                        <input type="hidden" value="">
                        <?= Html::activeFileInput($model, 'file',
                            ['onchange' => 'document.getElementById("fileName").value=this.value']) ?>

                        <div class="help-block"></div>
                    </div>
                    <div class="fonTypeFile"></div>
                    <input type="text" class="inputFileVal" placeholder="выберите файл" readonly="readonly"
                           id="fileName">
                </div>
            </div>
        </label>
        <label class="registration-contractor-form__label registration-contractor-form__label--required">
            <span>E-mail</span>

            <div class="registration-contractor-form__row">
                <?= Html::activeTextInput($model, 'username', ['class' => 'registration-contractor-form__input']) ?>
                <?= Html::error($model, 'username') ?>
            </div>
        </label>
        <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Специализации</span>

            <div class="registration-contractor-form__row">
                <a href="#" title="" data-click="modal" data-item="#specialization"
                   class="btn specialization-registration-contractor-form__btn registration-contractor-form__btn">
                    Выбрать специализации
                </a>
                <em>Максимум 150 специализаций</em>

                <div class="specialization-list-selected _specialization-list-selected">
                    <?php foreach ($model->specialization as $specialization): ?>
                        <?= Html::activeHiddenInput($model, 'specialization[]', ['value' => $specialization]) ?>
                    <?php endforeach ?>
                </div>
                <?= Html::error($model, 'specialization') ?>
            </div>
        </label>
        <label class="registration-contractor-form__label registration-contractor-form__label--required">
            <span>Города</span>

            <div class="registration-contractor-form__row">
                <a href="#" title="" data-click="modal" data-item="#cityList"
                   class="btn city-registration-contractor-form__btn registration-contractor-form__btn">Выбрать города
                </a>

                <div class="city-list-selected specialization-list-selected">
                    <?php foreach ($model->cityList as $specialization): ?>
                        <?= Html::activeHiddenInput($model, 'cityList[]', ['value' => $specialization]) ?>
                    <?php endforeach ?>
                </div>
                <?= Html::error($model, 'cityList') ?>
            </div>
        </label>
        <label class="registration-contractor-form__label registration-contractor-form__label--required">
            <span>Пароль</span>

            <div class="registration-contractor-form__row">
                <?= Html::activePasswordInput($model, 'password', ['class' => 'registration-contractor-form__input']) ?>
                <?= Html::error($model, 'password') ?>
            </div>
        </label>
        <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Повторите пароль</span>

            <div class="registration-contractor-form__row">
                <?= Html::activePasswordInput($model, 'password2',
                    ['class' => 'registration-contractor-form__input']) ?>
                <?= Html::error($model, 'password2') ?>
            </div>
        </label>
        <label
            class="registration-contractor-form__label registration-contractor-form__label--license"><span></span>

            <div class="registration-contractor-form__row">
                <?= Html::activeCheckbox($model, 'agree', ['label' => '']) ?>
                <?= \yii\helpers\Html::a('Я согласен с условиями пользования
                    сервисом', ['/cms/default/page', 'path' => 'usloviya'], ['target' => '_blank']) ?>
                <?= Html::error($model, 'agree') ?>
            </div>
        </label>
        <input type="submit" value="Зарегистрироваться" class="form__submit">
        <?= Html::endForm() ?>
    </section>
    <?= $this->render('//layouts/_sidebar') ?>
</main>
<?= \app\modules\cms\widgets\Specialization::widget([
    'modelName' => 'RegisterForm',
    'template'  => 'specializationRegister',
    'count'=>150,
]) ?>
<?= \app\modules\cms\widgets\Specialization::widget([
    'modelName' => 'RegisterForm',
    'alias'     => 'cityList',
    'template'  => 'cityList',
    'count'=>1000
]) ?>
