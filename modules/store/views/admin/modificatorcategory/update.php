<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\store\models\ModificatorCategory */

$this->title = Yii::t('app', 'Обновление');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Товары'), 'url' => ['/store/admin/product']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $model->product->title), 'url' => ['/store/admin/product/update','id'=>$model->product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modificator-category-update">


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

    <div class="panel panel-default">
        <div class="panel-heading">
            Данные:
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>Название</td>
                    <td>Значение</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach($model->items as $item):?>
                <tr>
                    <td><?=$item->title?></td>
                    <td><?=$item->content?></td>
                </tr>
                <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>
