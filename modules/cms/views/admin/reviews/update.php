<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Reviews */

$this->title = Yii::t('app', 'Обновление {modelClass}: ', [
    'modelClass' => 'отзыва',
]) . ' ' . $model->name.' ('.$model->company.')';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Отзывы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновление');
?>
<div class="reviews-update">

    <?php
    echo Tabs::widget([
        'items' => [
            [
                'id'=>'one',
                'label' => 'Основные данные',
                'content' => $this->render('_form', [
                    'model' => $model,
                ]),
                'active'=>true
            ],
            [
                'id'=>'two',
                'label' => 'Фото',
                'content' => \app\modules\cms\widgets\ImageUpload::widget(['model'=>$model,'primaryKey'=>$model->id,'maxNumberOfFiles'=>1]),
            ],
        ],
    ]);
    ?>

</div>
