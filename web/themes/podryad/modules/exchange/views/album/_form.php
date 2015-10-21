<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 07.10.15
 * Time: 10:52
 * @var $model \app\modules\exchange\models\Album
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin()?>
<?=$form->field($model,'title')?>
<?=Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить',['class'=>'create-album btn'])?>
<?php ActiveForm::end()?>