<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 06.10.15
 * Time: 16:54
 * @var $model \app\modules\exchange\models\Contactor
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin()?>
<?=$form->field($model->profile,'memo',['template'=>'{input} {error}'])->widget(\app\assets\Redactor::className(),[
    'userOptions'=>[
        'toolbar'=> [
            ['name'=>'document','items'=>['Source']],
            ['name'=>'basicstyles','items'=>['Bold','Italic','Strike']]
        ],
        'allowedContent' => 'p i strong strike',
        'extraAllowedContent' => false,
        'enterMode' => 1,
        'shiftEnterMode' => 0,
    ]
])?>
<?=Html::submitButton('Обновить',['class'=>'create-price btn obnovit'])?>
<?php ActiveForm::end()?>