<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\exchange\models\Offers */

$this->title = Yii::t('app', 'Create Offers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Offers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
