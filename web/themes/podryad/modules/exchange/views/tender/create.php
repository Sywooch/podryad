<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\exchange\models\Tender
 */
use yii\helpers\Html;

$this->title = 'Объявить тендер';

?>
<main class="main">
    <section class="registration-contractor-content">
        <div class="registration-contractor-content__title">Объявить тендер</div>
        <div class="registration-contractor-content__text">Пожалуйста, укажите свои реальные данные, это облегчит
            взаимодействие между вами и заказчиками
        </div>
        <?=Html::errorSummary($model,['class'=>'registration-contractor-content__text'])?>
            <?=Html::beginForm('','post',[
                'class'=>'registration-contractor-form',
                'enctype'=>'multipart/form-data',
            ])?>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Название тендера</span>

                <div class="registration-contractor-form__row">
                    <?=Html::activeTextInput($model,'title',['class'=>'registration-contractor-form__input'])?>
                    <?=Html::error($model,'title')?>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Специализации</span>

                <div class="registration-contractor-form__row">
                    <a href="#" title="" data-click="modal" data-item="#specialization" data-type="five-spec"
                       class="btn registration-contractor-form__btn" data-model="Tender">Выбрать специализацию
                    </a>
                    <em>Максимум 5 специализаций</em>

                    <div class="specialization-list-selected">
                        <?php foreach ($model->specializationIds as $specialization): ?>
                            <?= Html::activeHiddenInput($model, 'specializationIds[]', ['value' => $specialization]) ?>
                        <?php endforeach ?>
                        <?=Html::activeHiddenInput($model,'specializationId',['class'=>'Tender-specialization'])?>
                    </div>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Описания работы</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextarea($model, 'description', ['class' => 'form_textarea_tender']) ?>
                    <?= Html::error($model, 'description') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label"> <span>Прикрепить файлы</span>

                <div class="registration-contractor-form__row">
                    <div class="type_file">
                        <div class="form-group field-reviews-file">
                            <input type="hidden" value="">
                            <?= Html::activeFileInput($model, 'file', ['onchange'=>'document.getElementById("fileName").value=this.value']) ?>

                            <div class="help-block"></div>
                        </div>
                        <div class="fonTypeFile"></div>
                        <input type="text" class="inputFileVal" placeholder="выберите файл" readonly="readonly"
                               id="fileName">
                    </div>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Контактный телефон</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'phone', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'phone') ?>
                </div>
            </label>
            <label class="registration-contractor-form__label registration-contractor-form__label--required"> <span>Бюджет проекта</span>

                <div class="registration-contractor-form__row">
                    <?= Html::activeTextInput($model, 'price', ['class' => 'registration-contractor-form__input']) ?>
                    <?= Html::error($model, 'price') ?>
                    <?=Html::activeCheckbox($model,'negotiable',['value'=>1])?>
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
            <input type="submit" value="ОБЪЯВИТЬ ТЕНДЕР" class="form__submit">
        <?=Html::endForm()?>
    </section>
    <?=$this->render('//layouts/_sidebar')?>
</main>
<?= \app\modules\cms\widgets\Specialization::widget(['type'=>'five-spec','modelName'=>'Tender']) ?>