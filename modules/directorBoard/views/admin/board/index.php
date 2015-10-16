<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\directorBoard\models\BoardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Сотрудники');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="board-index">

    <p>
        <?= Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <pre>Ссылка на модуль: <?=htmlspecialchars('<?=\yii\helpers\Url::to(["/directorBoard/default"])?>');?></pre>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            ['attribute'=>'categoryId','value'=>'category','filter'=>\app\modules\directorBoard\models\Board::categoryList()],
            ['header'=>'фото','value'=>function($model){
                if($model->image)
                        return Html::img($model->image->resize('75x75'));
            },
            'format'=>'html'],
            'title',
            'alias',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
