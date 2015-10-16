<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Reference */

$this->title = Yii::t('app', 'Обновление: '.$model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Справочники'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-update">

    <p>
        <?= Html::a(Yii::t('app', 'Создать справочник'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
