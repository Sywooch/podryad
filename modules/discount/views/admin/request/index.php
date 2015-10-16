<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\discount\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Заявки');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            ['attribute'=>'cityId','value'=>'city.title','filter'=>\app\modules\cms\models\City::dropDown()],
            'email:email',
            'phone',
            [
                'attribute'=>'status',
                'value'=>'statusText',
                'filter'=>\app\modules\discount\models\Request::getStatusList(),
            ],
            'dateCreate:date',
            'dateActivate:date',
            // 'dateCreate',
            // 'dateActivate',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'accept'=>function($url,$model){
                            return Html::a('<i class="fa fa-users"></i>',$url,['class'=>'btn btn-success btn-xs']);
                    },
                    'update'=>function($url,$model){
                        return Html::a('<i class="fa fa-edit"></i>',$url,['class'=>'btn btn-primary btn-xs']);
                    },
                    'reject'=>function($url,$model){
                        return Html::a('<i class="fa fa-undo"></i>',$url,['class'=>'btn btn-danger btn-xs']);
                    }
                ],
                'template'=>'{accept} | {reject} | {view} |{delete}',
                'options'=>[
                    'class'=>'col-md-1',
                    'style'=>'width:130px;text-align:center',
                ]
            ],
        ],
    ]); ?>

</div>
