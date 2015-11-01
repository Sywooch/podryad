<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Статьи');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">


    <pre>Ссылка на модуль: <?=htmlspecialchars('<?=\yii\helpers\Url::to(["/cms/article/list","type"=>"(news|article|stock)"])?>');?></pre>


    <p>
        <?= Html::a(Yii::t('app', 'Добавить статью'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'header'=>'',
                'value'=>function($model){
                    return Html::img($model->imageSrc('100x100'));
                },
                'format'=>'html'
            ],
            'title',
            'dateCreate',
            ['attribute'=>'type','filter'=>\app\modules\cms\models\Article::typeList(),'value'=>'typeView'],
            'alias',
            // 'visible',
            // 'dateCreate',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
        ],
    ]); ?>

</div>
