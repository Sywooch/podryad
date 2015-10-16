<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Block */

$this->title = Yii::t('app', 'Добавление');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Блоки'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
