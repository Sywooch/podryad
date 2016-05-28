<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\exchange\models\Album */

$this->title = 'Редактировать Альбом: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Фотографии', 'url' => ['/admin/cms/user/update','id'=>$model->userId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
