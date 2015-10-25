<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 06.10.15
 * Time: 16:03
 * @var $dateProvider \yii\data\ActiveDataProvider
 */
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
?>
    <a href="<?=Url::to(['/exchange/contractor-price/create'])?>">Добавить</a>
    <br/>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        'price',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons'=>[
                'update'=>function($url,$model)
                {
                    return Html::a('ред',['/exchange/contractor-price/update','id'=>$model->id]);
                },
                'delete' => function ($url, $model) {
                    return Html::a('удал', ['/exchange/contractor-price/delete', 'id' => $model->id]);
                }
            ]
        ],
    ],
]) ?>