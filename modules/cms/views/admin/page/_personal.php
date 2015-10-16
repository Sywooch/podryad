<?php
/**
 * @var $page \app\modules\cms\models\Page
 * @var $model \app\modules\cms\models\PageDoctor
 */
use app\modules\cms\models\PageDoctorSearch;
use yii\grid\GridView;
use yii\helpers\Html;
$searchModel = new PageDoctorSearch();
$searchModel->pageId = $page->id;
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>

<div class="page-doctor-index">
    <br/>
    <?=Html::a('Добавить врача',['/cms/admin/pagedoctor/create','pageId'=>$page->id],['class'=>'btn btn-primary'])?>
    <br/><br/>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute'=>'doctorId','value'=>'doctor.title'],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}',
                'buttons'=>[
                    'delete'=>function($url,$model)
                    {
                        /** @var $model \app\modules\cms\models\PageDoctor */
                        return Html::a('Удалить',['/cms/admin/pagedoctor/delete','id'=>$model->id,'pageId'=>$model->pageId],['data-method'=>'post']);
                    }
                ],
            ],
        ],
    ]); ?>

</div>