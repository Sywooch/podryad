<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Block */

$this->title = Yii::t('app', 'Обновление блока: '. $model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-update">

    <?php
    echo \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'id' => 'one',
                'label' => 'Страница',
                'content' => $this->render('_form', [
                    'model' => $model,
                ]),
                'active' => $tab == 'main'
            ],
            [
                'id' => 'two',
                'label' => 'Картинки',
                'content' => \app\modules\cms\widgets\ImageUpload::widget(['model' => $model, 'primaryKey' => $model->id, 'maxNumberOfFiles' => 100]),
            ],
        ],
    ]);
    ?>

</div>
