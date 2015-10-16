<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Item */

$this->title = Yii::t('app', 'Создание');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список тем'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
