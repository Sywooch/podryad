<?php

/** @var $this \yii\web\View */
/** @var $model \app\modules\exchange\models\Contactor */
/** @var $profile \app\modules\cms\models\Profile */

use yii\helpers\Html;
use yii\grid\GridView;

?>
<div class="well">
    <p>
        <?= Html::a(Yii::t('app', 'Добавить'), ['/admin/exchange/album/create','userId'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([

        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => \app\modules\exchange\models\Album::find()->where(['userId' => $model->id])
        ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'class'=>'yii\grid\ActionColumn',
                'template'=>'{update}{delete}',
                'controller'=>'/admin/exchange/album'
            ]
        ],
    ]); ?>
</div>

