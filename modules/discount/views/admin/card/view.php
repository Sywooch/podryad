<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\discount\models\Card */

$this->title = 'Карточка: '.$model->cvcode;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cvcode',
            'dateCreate:date',
            'datePrint:date',
            'dateActivate:date',
            ['attribute'=>'status','value'=>$model->statusText],
            'userId',
        ],
    ]) ?>

</div>
