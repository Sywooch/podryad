<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 20.10.15
 * Time: 10:33
 * @var $offers \app\modules\exchange\models\Offers[]
 */
?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $offers,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        ['header'=>'Подрядчик','value'=>function($model){
            /** @var $model \app\modules\exchange\models\Offers */
           return \yii\helpers\Html::a($model->user->username,['/cms/admin/user/update','id'=>$model->user->id]);
        },'format'=>'html'],
        'description',
        'price',
        'dateAdd:datetime',
        ['header'=>'','value'=>'selectedText'],

        ['class' => 'yii\grid\ActionColumn',
            'template' => '{delete}'],
    ],
]); ?>