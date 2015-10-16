<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Reference */

$this->title = Yii::t('app', 'Создание');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Справочники'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
