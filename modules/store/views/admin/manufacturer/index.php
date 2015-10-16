<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\store\models\ManufacturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Производители');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-index">

    <p>
        <?= Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'header'=>'',
                'format'=>'html',
                'value'=>function($model)
                {
                    return Html::img($model->image->resize('75x75'));
                }
            ],
            'title',
            'alias',
            ['attribute'=>'visible','value'=>'visibleDisplay','filter'=>\app\modules\store\models\Category::visibleList()],
            'position',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
