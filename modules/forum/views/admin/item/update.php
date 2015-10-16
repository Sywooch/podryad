<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Item */
/* @var $answerList array */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список тем'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-update">

    <?php
    echo \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'id' => 'one',
                'label' => 'Основные данные',
                'content' => $this->render('_form', [
                    'model' => $model,
                ]),
            ],
            [
                'id' => 'two',
                'label' => 'Картинка',
                'content' => \app\modules\cms\widgets\ImageUpload::widget(['model' => $model, 'primaryKey' => $model->id, 'maxNumberOfFiles' => 1]),
            ],
            [
                'id' => 'answer',
                'label' => 'Ответы',
                'content' => $this->render('_answer',['answerList'=>$answerList,'model'=>$model]),
                'active'=>$tab == 'answer',
            ],
        ],
    ]);
    ?>

</div>
