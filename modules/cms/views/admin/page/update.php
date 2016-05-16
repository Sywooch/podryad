<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Page */

$this->title = Yii::t('app', 'Редактирование: ') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-update">

    <?php
    echo \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'id'=>'one',
                'label' => 'Страница',
                'content' => $this->render('_form', [
                    'model' => $model,
                ]),
                'active'=> $tab == 'main'
            ],
            [
                'id'=>'two',
                'label' => 'Картинка',
                'content' => \app\modules\cms\widgets\ImageUpload::widget(['model'=>$model,'primaryKey'=>$model->id,'maxNumberOfFiles'=>100]),
            ],
           /* [
                'id'=>'price',
                'label' => 'Услуга',
                'content' => \app\modules\cms\widgets\admin\Price::widget(['object'=>$model,'objectId'=>$model->id]),
                'active'=> $tab == 'price'
            ],
            [
               'id'=>'personal',
                'label'=>'Персонал',
                'content'=>$this->render('_personal',['page'=>$model]),
                'active'=> $tab == 'personal',
            ],*/
        ],
    ]);
    ?>

</div>
