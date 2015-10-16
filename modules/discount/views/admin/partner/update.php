<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\modules\discount\models\Partner */

$this->title = Yii::t('app', 'Редактирование партнёра: ') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="partner-update">


    <?php
    echo Tabs::widget([
        'items' => [
            [
                'id'=>'one',
                'label' => 'Основные данные',
                'content' => $this->render('_form', [
                    'model' => $model,
                    'category' => $category,
                ]),
                'active'=>$section == 'one',
            ],
            [
                'id'=>'two',
                'label' => 'Скидки',
                'content' => $this->render('_service',['service'=>$service,'model'=>$model,'serviceDataProvider'=>$serviceDataProvider]),
                'active'=>$section == 'two',
            ],
        ],
    ]);
    ?>

</div>
