<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\exchange\models\Album */

$this->title = 'Создание альбома';
$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['model']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
