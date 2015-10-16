<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\discount\models\PartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="partner-service-index">

    <br/>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить'), ['/discount/admin/service/create','parentId'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $serviceDataProvider,
        'filterModel' => $service,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'discount',
            // 'workTime',
            // 'phones',
            // 'description:ntext',
            // 'metaKeywords',
            // 'metaDescription',
            // 'dateCreate',
            // 'visible',
            // 'parentId',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller'=>'/admin/discount/service',
                'template'=>'{update}{delete}'
            ],
        ],
    ]); ?>

</div>