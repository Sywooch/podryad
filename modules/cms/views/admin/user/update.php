<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\User */

$this->title = Yii::t('app', 'Редактирование пользователя: ') . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
        'profile' => $profile,
    ]) ?>

</div>
