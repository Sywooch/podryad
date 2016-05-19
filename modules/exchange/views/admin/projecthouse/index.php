<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\exchange\models\ProjecthouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты домов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projecthouse-index">

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'alias',
            'description:ntext',
//            'yandexDisk',
            // 'googleDisk',
            // 'skyDrive',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
