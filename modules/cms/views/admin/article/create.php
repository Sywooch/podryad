<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Article */

$this->title = Yii::t('app', 'Добавление');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Статьи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
