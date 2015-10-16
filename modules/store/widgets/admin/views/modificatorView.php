<?php
/**
 * @var $this \yii\base\Widget
/* @var $modelProduct Product
/* @var $searchModel app\modules\store\models\ModificatorCategorySearch
/* @var $dataProvider yii\data\ActiveDataProvider
 */
?>

<div class="modificator-category-index">

    <h1>Модификаторы</h1>

    <div class="well">
        <?php $form = \yii\bootstrap\ActiveForm::begin([
            'action'=>['/store/admin/modificatorcategory/import'],
            'enableAjaxValidation'=>true,
            'options'=>[
                'enctype'=>'multipart/form-data',
                'class'=>'form-inline'
            ],
        ])?>
        <?=\yii\helpers\Html::activeHiddenInput($modelUpload,'productId',['value'=>$modelProduct->id])?>
        <?=\yii\helpers\Html::activeHiddenInput($modelUpload,'categoryId',['value'=>$modelProduct->category->id])?>
        <?=$form->field($modelUpload,'file')->fileInput()?>
        <?=\yii\helpers\Html::submitButton('Загрузить',['class'=>'btn btn-success'])?>
        <?php \yii\bootstrap\ActiveForm::end()?>
    </div>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            // 'alias',
            // 'memo',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'buttons'=>[
                    'update'=>function($urk,$model)
                    {
                        return \yii\helpers\Html::a('Редактировать',['/store/admin/modificatorcategory/update','id'=>$model->id]);
                    },
                    'delete'=>function($url,$model)
                    {
                        return \yii\helpers\Html::a('Удалить',['/store/admin/modificatorcategory/delete','id'=>$model->id],['data-method'=>'post']);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
