<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\CustomSeo */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => 'Конструктор СЕО', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-seo-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
