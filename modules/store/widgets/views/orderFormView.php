<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\store\models\Order
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$theme = $this->theme;
?>
<div id="modal2" class="modal_div"> <!-- скрытый див с уникальным id = modal1 -->
    <span class="modal_close"></span>
    <span class="title_z">Заказ товара</span>
    <?php $form = ActiveForm::begin([
        'action'=>['/store/order/make'],
        'options'=>['class' => '_order-form'],
        'enableAjaxValidation'=>true,
        'fieldConfig' => [
            'template' => '{input}{error}',
            'inputOptions'=>['class'=>'modal_f'],
        ],
    ]) ?>
    <?=$form->field($model,'fio')->textInput(['placeholder'=>'ФИО...'])?>
    <?=$form->field($model,'phone')->textInput(['placeholder'=>'Номер...'])?>
    <?=$form->field($model,'email')->textInput(['placeholder'=>'Почта...'])?>


    <div class="korzina m-a">
        <img src="<?= $theme->getUrl('img/korzina.jpg') ?>" alt="Корзина"/>
        <span>Товаров выбрано <b><var class="_basket-count">0</var> шт</b></span>
    </div>
    <button type="submit" name="submit2">Заказать</button>
    <?php ActiveForm::end() ?>
</div>
<div id="overlay"></div>