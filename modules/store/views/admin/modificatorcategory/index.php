<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\store\models\ModificatorCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Modificator Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modificator-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Modificator Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'productId',
            'categoryId',
            'title',
            'titleLink',
            // 'alias',
            // 'memo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
