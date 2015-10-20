<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 14.10.15
 * Time: 17:17
 * @var $model \app\modules\cms\models\form\Feedback
 */
?>
<div id="back_hunter" class="modal back_hunter">
    <div class="modal__close">x</div>
    <div class="modal__title">Обратная связь</div>
    <?php $form = \yii\widgets\ActiveForm::begin([
        'action'=>['/cms/default/feedback'],
        'enableAjaxValidation'=>true,
        'fieldConfig'=>[
            'labelOptions'=>['class'=>'form__label form__label--required'],
            'inputOptions'=>['class'=>'form__label form__label--required form-control'],
        ]
    ])?>
        <?=$form->field($model,'name')?>
        <?=$form->field($model,'email')?>
        <?=$form->field($model,'phone')?>
        <?=$form->field($model,'message')->textarea(['class'=>'form_textarea_tender'])?>
        <input type="submit" value="Отправить" class="form__submit">
    <?php \yii\widgets\ActiveForm::end()?>
</div>