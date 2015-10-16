<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\ReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Отзывы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">


    <p>
        <?= Html::a(Yii::t('app', 'Добавить отзыв'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'dateCreate',
                'filter'=>\yii\jui\DatePicker::widget(
                    [
                        'model'=>$searchModel,
                        'attribute'=>'dateCreate',
                        'dateFormat'=>'yyyy-MM-dd',
                        'options'=>['class'=>'form-control']
                    ]
                )
            ],
            ['attribute'=>'visible','value'=>'visibleView','filter'=>\app\modules\cms\models\Reviews::visibleList()],
            [
                'header'=>'',
                'value'=>function($model){
                    /** @var $model \app\modules\cms\models\Reviews */
                    return Html::img($model->imageSrc('50x50'),['class'=>'img-circle']);
                },
                'format'=>'html',
            ],
            'name',
            'age',
            'company',
            'content',
            // 'visible',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
        ],
    ]); ?>

</div>
