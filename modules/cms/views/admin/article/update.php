<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Article */

$this->title = Yii::t('app', 'Обновление {modelClass}: ', [
    'modelClass' => 'Статьи',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Статьи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновление');
?>
<div class="article-update">

<?php
echo Tabs::widget([
    'items' => [
        [
            'id'=>'one',
            'label' => 'Основные данные',
            'content' => $this->render('_form', [
                'model' => $model,
            ]),
            'active'=>true
        ],
        [
            'id'=>'two',
            'label' => 'Картинки',
            'content' => \app\modules\cms\widgets\ImageUpload::widget(['model'=>$model,'primaryKey'=>$model->id,'maxNumberOfFiles'=>1]),
        ],
    ],
]);
?>

</div>
