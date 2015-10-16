<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\store\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Товары');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

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
                    return Html::img($model->image->resize());
                }
            ],
            [
                'attribute'=>'categoryId',
                'value'=>function($model){
                    return $model->category->title;
                },
                'filter'=>\app\modules\store\models\Category::dropDown()
            ],
            /*[
                'attribute'=>'manufacturerId',
                'value'=>function($model){
                    return $model->manufacturer->title;
                },
                'filter'=>\app\modules\store\models\Manufacturer::dropDown()
            ],*/
            ['attribute'=>'visible','value'=>'visibleDisplay','filter'=>\app\modules\store\models\Product::visibleList()],
            'title',
            'alias',
            // 'content',
            // 'minCount',
            // 'quantity',
            // 'visible',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
