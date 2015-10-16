<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Reviews */

$this->title = Yii::t('app', 'Создание отзыва');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Отзывы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
