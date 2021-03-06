<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\BlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Блоки');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-index">
    <p>
        <?= Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'alias',
            'title',
//            'content:ntext',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>

</div>
