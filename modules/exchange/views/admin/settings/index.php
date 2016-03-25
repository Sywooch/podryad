<?php
/** @var $this \yii\web\View */
/** @var $model \app\modules\exchange\models\forms\TenderSettings */
/** @var $provider \yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Общие настройки';
?>
<div class="well">
    <?php $form = \yii\widgets\ActiveForm::begin() ?>
    <?php
    echo GridView::widget([
        'dataProvider'=>$provider,
        'columns'=>[
            'id',
            'module',
            'name',
            [
                'attribute'=>'value',
                'value'=>function($model, $attributes, $key)
                {
                    return Html::textarea('Settings['.$model->id.'][value]',$model->value,['class'=>'form-control']);
                },
                'format'=>'raw',
            ]
        ]
    ])
    ?>

    <div class="form-group">
        <input type="submit" value="Сохранить" class="btn">
    </div>
    <?php \yii\widgets\ActiveForm::end() ?>
</div>
