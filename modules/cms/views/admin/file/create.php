<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\File */

$this->title = Yii::t('app', 'Добавить файл ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Библиотека'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
