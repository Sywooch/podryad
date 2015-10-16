<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $tab string */
/* @var $model app\modules\store\models\Product */

$this->title = 'Обновление';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Товары'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновление');
?>
<div class="product-update">

    <?php
    echo Tabs::widget([
        'items' => [
            [
                'id'=>'one',
                'label' => 'Основные данные',
                'content' => $this->render('_form', [
                    'model' => $model,
                ]),
                'active'=>$tab == 'main'
            ],
            [
                'id'=>'photo',
                'label' => 'Фото',
                'content' => \app\modules\cms\widgets\ImageUpload::widget(['model'=>$model,'primaryKey'=>$model->id,'maxNumberOfFiles'=>1]),
                'active'=>$tab == 'photo'
            ],
            [
                'id'=>'two',
                'label' => 'Модификаторы',
                'content' => \app\modules\store\widgets\admin\Modificator::widget(['model'=>$model]),
                'active'=>$tab == 'modificator'
            ],
        ],
    ]);
    ?>

</div>
