<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Rate */

$this->title = Yii::t('app', 'Добавление пункта');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Рейтинг'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rate-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
