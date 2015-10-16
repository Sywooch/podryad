<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\discount\models\Partner */

$this->title = Yii::t('app', 'Добавить партнёра');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-create">

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
    ]) ?>

</div>
