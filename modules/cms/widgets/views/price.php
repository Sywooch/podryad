<?php
/**
 * @var $this \yii\base\Widget
 * @var $model \app\modules\cms\models\Price
 * @var $form PriceForm;
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="zapis">
    <span><?=$model->title?>: <?=$model->price?> тг</span>
    <a href="#modal2" class="open_modal">
        <div class="vsex_contact  sl  m-no fl_r vnutr_f">
            ЗАПИСАТЬСЯ НА ПРИЕМ
        </div>
    </a>
</div>

<!--Модальные окно-->
<div id="overlay"></div><!-- Подложка, одна на всю страницу -->

<div id="modal2" class="modal_div"> <!-- скрытый див с уникальным id = modal1 -->
    <span class="modal_close"></span>
    <?php $form = ActiveForm::begin([
        'action'=>['/cms/price'],
        'enableAjaxValidation'=>true,
    ])?>
    <?=$form->field($model,'name')->textInput(['placeholder'=>'Имя...'])?>
    <?=$form->field($model,'phone')->textInput(['placeholder'=>'Номер...'])?>
    <?=Html::submitButton('ЗАПИСАТЬСЯ НА ПРИЕМ')?>
    <?php ActiveForm::end()?>
</div>
<!-- -->
