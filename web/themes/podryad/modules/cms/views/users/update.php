<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 13.10.15
 * Time: 11:48
 * @var $this \yii\web\View
 * @var $model \app\modules\cms\models\form\RegisterForm
 * @var $profile \app\modules\cms\models\Profile
 */
use yii\helpers\Html;
$this->title = 'Обновление профиля:';
?>
    <main class="main">
        <section class="registration-contractor-content">
            <div class="registration-contractor-content__title">Регистрация подрядчика</div>
            <div class="registration-contractor-content__text">Пожалуйста, укажите свои реальные данные, это облегчит
                взаимодействие между вами и заказчиками
            </div>
            <?= Html::errorSummary([$model], ['class' => 'registration-contractor-content__text']) ?>

            <?= Html::beginForm('','post',['enctype'=>'multipart/form-data']) ?>
            <?=Html::activeHiddenInput($model,'role')?>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Ф.И.О</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'fio', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'fio') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required">
                <span>Компания:</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'company', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'company') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Контактный телефон</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'phone', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'phone') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label"> <span>Прикрепить файлы</span>

                <div class="registration-contractor-form__row">
                    <?php if( ($image = $profile->imageSrc()) ):?>
                        <img src="<?=$image?>" alt=""/>
                    <?php endif?>
                    <div class="type_file">
                        <div class="form-group field-reviews-file">
                            <input type="hidden" value="">
                            <?= Html::activeFileInput($model, 'file', ['onchange' => 'document.getElementById("fileName").value=this.value']) ?>

                            <div class="help-block"></div>
                        </div>
                        <div class="fonTypeFile"></div>
                        <input type="text" class="inputFileVal" placeholder="выберите файл" readonly="readonly"
                               id="fileName">
                    </div>
                </div>
            </label>
            <?php if( ($specializationList = $profile->specializations) ):?>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Специализации</span>

                <div class="registration-contractor-form__row">
                    <a href="#" title="" data-click="modal" data-item="#specialization"
                       class="btn registration-contractor-form__btn">Выбрать специализацию
                    </a>
                    <em>Максимум 10 специализаций</em>

                    <div class="specialization-list-selected">
                        <?php foreach($specializationList as $specialization):?>
                        <div class="specialization-list-selected__item"><?=$specialization->title?></div>
                        <?=Html::activeHiddenInput($model,'specialization[]',['value'=>$specialization->id])?>
                        <?php endforeach?>
                    </div>
                    <input type="hidden" value="" class="specialization-input-send">
                    <?= Html::error($model, 'specialization') ?>
                </div>
            </label>
            <?php endif?>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Где вы готовы работать?</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeDropDownList($model, 'cityId', \app\modules\cms\models\Reference::findOne(['alias' => 'cityList'])->dropDown(), ['class' => 'registration-contractor-form__input']) ?>
                    <em>Укажите только те города в которых вы готовы работать.</em>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Пароль</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activePasswordInput($model, 'password', ['class' => 'registration-contractor-form__input','value'=>'']) ?>
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
            <input type="submit" value="Обновить" class="form__submit">
            <?= Html::endForm() ?>
        </section>
        <?= $this->render('//layouts/_sidebar') ?>
    </main>
<?= \app\modules\cms\widgets\Specialization::widget(['modelName' => 'RegisterForm','specializationList'=>$specializationList]) ?>