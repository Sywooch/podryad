<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Pyramid */

$this->title = Yii::t('app', 'Добавить элемент');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pyramids'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pyramid-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
