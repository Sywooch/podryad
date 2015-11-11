<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 03.10.15
 * Time: 11:43
 * @var $model \app\modules\exchange\models\Offers
 * @var $tenderId integer
 */
use yii\widgets\ActiveForm;
?>
<div id="zakaz_tender" class="modal zakaz_tender">
    <div class="modal__close">x</div>
    <div class="modal__title">Принять участие в тендере</div>
        <?php $form = ActiveForm::begin([
            'id'=>'offers-form',
            'options'=>['class'=>'form'],
            'validationUrl'=>['/exchange/offers/validate-create'],
            'action'=>['/exchange/offers/create','tenderId'=>$tenderId],
            'fieldConfig'=>[
                'labelOptions'=>['form__label form__label--required'],
            ],
            'enableAjaxValidation'=>true,
        ])?>
        <?= $form->field($model, 'price')->textInput(['class'=>'form__input']) ?>
        <?= $form->field($model, 'description')->textarea(['class' => 'form_textarea']) ?>
        <input type="submit" value="Участвовать" class="form__submit">
    <?php ActiveForm::end()?>
</div>