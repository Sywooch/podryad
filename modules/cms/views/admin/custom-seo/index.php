<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CustomSeoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Конструктор СЕО';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-seo-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute'=>'cityId','value'=>'city.title'],
            ['attribute'=>'specializationId','value'=>'specialization.title'],
            'h1',
            'title',
            // 'metaKeywords',
            // 'metaDescription',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>

<?php Pjax::end(); ?></div>
