<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\discount\models\Request */

$this->title = Yii::t('app', 'Редактирование запроса:') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="request-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
