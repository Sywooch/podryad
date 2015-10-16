<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\forum\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Список тем');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">


    <p>
        <?= Html::a(Yii::t('app', 'Создать тему'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['header'=>'','value'=>function($model){
                /** @var $model \app\modules\forum\models\Item */
                return Html::img($model->imageSrc('50x50'));
            },'format'=>'html'],
            'title',
//            'description:ntext',
            'dateCreate:date',
            'alias',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>

</div>
