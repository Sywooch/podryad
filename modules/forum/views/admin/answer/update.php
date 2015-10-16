<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Answer */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Форум: '.$model->forum->title), 'url' => ['/forum/admin/item/update','id'=>$model->forumId,'tab'=>'answer']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
