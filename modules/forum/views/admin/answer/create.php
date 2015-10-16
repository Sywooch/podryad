<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Answer */
/* @var $forum \app\modules\forum\models\Item*/

$this->title = Yii::t('app', 'Добавить ответ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Форум: '.$forum->title), 'url' => ['/forum/admin/item/update','id'=>$forum->id,'tab'=>'answer']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
