<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\exchange\models\Tender */
/* @var $offers \app\modules\exchange\models\Offers[] */

$this->title = Yii::t('app', 'Редактирование');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Тендера'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tender-update">

    <?php
    echo \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'id' => 'one',
                'label' => 'Основные данные',
                'content' => $this->render('_form', [
                    'model' => $model,
                ]),
                'active' => true
            ],
            [
                'id' => 'two',
                'label' => 'Картинки',
                'content' => \app\modules\cms\widgets\ImageUpload::widget(['model' => $model, 'primaryKey' => $model->id, 'maxNumberOfFiles' => 1]),
            ],
            [
                'id'=>'offers',
                'label'=>'Предложения',
                'content'=>$this->render('_offers',['offers'=>$offers]),
            ]
        ],
    ]);
    ?>

</div>
