<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\File */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Библиотека'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
