<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model \app\modules\store\models\Category */
/* @var $searchModel app\modules\store\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Категории');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">


    <p>
        <?= Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <pre>Ссылка на модуль: <?=htmlspecialchars('<?=\yii\helpers\Url::to(["/store/category"])?>');?></pre>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
              'header'=>'',
                'format'=>'html',
                'value'=>function($model)
                {
                    return Html::img($model->image->resize('32x29'));
                }
            ],
            'title',
            'alias',
            ['attribute'=>'visible','value'=>'visibleDisplay','filter'=>\app\modules\store\models\Category::visibleList()],
            'position',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
