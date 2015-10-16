<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\directorBoard\models\Board */

$this->title = 'Обновление';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сотрудники'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => $model->path];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="board-update">

    <?php
    echo \yii\bootstrap\Tabs::widget([
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
