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
use yii\helpers\Url;
$this->title = 'Обновление профиля:';
$cityList = \app\modules\cms\models\Reference::findOne(['alias' => 'cityList'])->children();
$cityDropdown = \yii\helpers\ArrayHelper::map($cityList, 'id', 'title');
?>
    <main class="main">
        <section class="registration-contractor-content">
            <div class="registration-contractor-content__title">Редактирование профиля</div>

            <br/>

            <a href="<?= Url::to(
                \Yii::$app->user->identity->role == \app\modules\cms\models\User::ROLE_CONTRACTOR ?
                    ['/exchange/contractor/view', 'id' => \Yii::$app->user->id] : ['/cms/users/view']) ?>" title=""
               class="contractor-back">Вернуться в профиль
            </a>
            <br/>

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
            <label class="registration-contractor-form__label">
                <span>Компания:</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'company', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'company') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label">
                <span>Сайт:</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'site', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'site') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label">
                <span>Адрес:</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'adres', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'adres') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Контактный телефон</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'phone', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'phone') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label"> <span>Заголовок страницы</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'metaTitle', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'metaTitle') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label"> <span>Ключевые слова</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'metaKeywords', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'metaKeywords') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label"> <span>Описание для поисковиков</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'metaDescription', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'metaDescription') ?>
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
                       class="btn specialization-registration-contractor-form__btn registration-contractor-form__btn">Выбрать специализацию
                    </a>
                    <em>Максимум 10 специализаций</em>

                    <div class="specialization-list-selected _specialization-list-selected">
                        <?php foreach($specializationList as $specialization):?>
                        <div class="specialization-list-selected__item"><?=$specialization->title?></div>
                        <?=Html::activeHiddenInput($model,'specialization[]',['value'=>$specialization->id])?>
                        <?php endforeach?>
                    </div>
                    <?= Html::error($model, 'specialization') ?>
                </div>
            </label>
            <?php endif?>
            <?php if (($cityList = $profile->cityLists)): ?>
                <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Города</span>

                    <div class="registration-contractor-form__row">
                        <a href="#" title="" data-click="modal" data-item="#cityList"
                           class="btn city-registration-contractor-form__btn registration-contractor-form__btn">Выбрать города
                        </a>
                        <em>Максимум 10 городов</em>

                        <div class="city-list-selected specialization-list-selected">
                            <?php foreach ($cityList as $city): ?>
                                <div class="specialization-list-selected__item"><?= $city->title ?></div>
                                <?= Html::activeHiddenInput($model, 'specialization[]', ['value' => $city->id]) ?>
                            <?php endforeach ?>
                        </div>
                        <?= Html::error($model, 'specialization') ?>
                    </div>
                </label>
            <?php endif ?>
            <label class="registration-contractor-form__label"> <span>Пароль</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activePasswordInput($model, 'password', ['class' => 'registration-contractor-form__input','value'=>'']) ?>
                    <?= Html::error($model, 'password') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label"> <span>Повторите пароль</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activePasswordInput($model, 'password2', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'password2') ?>
                </div>
            </label>
            <input type="submit" value="Обновить" class="form__submit">
            <?= Html::endForm() ?>
        </section>
        <?= $this->render('//layouts/_sidebar') ?>
    </main>
<?= \app\modules\cms\widgets\Specialization::widget(['modelName' => 'RegisterForm','specializationList'=>$specializationList]) ?>
<?= \app\modules\cms\widgets\Specialization::widget(['modelName' => 'RegisterForm', 'alias' => 'cityList', 'template' => 'cityList','specializationList'=>$cityList]) ?>
