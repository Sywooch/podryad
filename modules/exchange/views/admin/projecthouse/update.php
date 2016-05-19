<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\exchange\models\Projecthouse */

$this->title = 'Редактирование проекта: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Проекты домов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projecthouse-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
