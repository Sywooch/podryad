<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\discount\models\Request */
?>

<h1>Новая заявка на получение карты на сайте: <?= Yii::$app->name ?></h1>
Категория: <?= $model->typeTitle ?><br>
Город: <?= $model->city->title ?><br>
Ф.И.О: <?= $model->username ?><br>
Email: <?= $model->email ?><br>
Телефон: <?= $model->phone ?><br>