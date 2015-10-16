<?php
/**
 * @var $model \app\modules\forum\models\Item
 * @var $answerList \yii\data\ActiveDataProvider
 */
use yii\grid\GridView;
use yii\helpers\Html;
?>

<div class="well">

    <p>
        <?= Html::a(Yii::t('app', 'Добавить ответ'), ['/forum/admin/answer/create','forumId'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $answerList,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'content:ntext',
            'dateCreate:date',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}','buttons'=>[
                'update'=>function($url,$model)
                {
                    return Html::a('Редактировать',['/forum/admin/answer/update','id'=>$model->id]);
                },
                'delete' => function ($url,$model) {
                    return Html::a('Удалить', ['/forum/admin/answer/delete', 'id' => $model->id],['data-method'=>'post']);
                }
            ]],
        ],
    ]); ?>
</div>

