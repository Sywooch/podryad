<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Reference */
/* @var $searchModel app\modules\cms\models\ReferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Справочники');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-index">


    <p>
        <?= Html::a(Yii::t('app', 'Создать справочник'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            ['attribute'=>'parentId','value'=>function($model){
                return $model->parent ? $model->parent->title : null;
            },
            'filter'=>Html::activeDropDownList($searchModel,'parentId',$model->dropDown(),['prompt'=>''])],
            'alias',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>

</div>
