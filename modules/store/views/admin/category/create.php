<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\store\models\Category */

$this->title = Yii::t('app', 'Добавление');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Категории'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
