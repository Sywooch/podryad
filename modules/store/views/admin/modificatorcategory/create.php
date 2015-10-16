<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\store\models\ModificatorCategory */

$this->title = Yii::t('app', 'Create Modificator Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modificator Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modificator-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
