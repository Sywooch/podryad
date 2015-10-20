<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Тендера');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tender-index">

    <!--<p>
        <?/*= Html::a(Yii::t('app', 'Create Tender'), ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute'=>'title','value'=>function($model){
                return Html::a($model->title,['/exchange/tender/view','id'=>$model->id],['target'=>'_blank']);
            },'format'=>'raw'],
//            'description:ntext',
            ['attribute'=>'userId','value'=>'user.username'],
            ['header'=>'Предложений','value'=>'offersCount'],
            'phone',
             ['attribute'=>'price','value'=>'priceString'],
             ['attribute'=>'active','value'=>'statusTitle'],
            // 'specializationId',
            // 'userId',
             'dateCreate:date',
            // 'contractorId',
            // 'offersId',

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{update} {delete}'],
        ],
    ]); ?>

</div>
