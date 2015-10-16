<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\PageDoctor */
/* @var $page app\modules\cms\models\Page */

$this->title = Yii::t('app', 'Добавление врача на страницу "'.$page->title.'"');
$this->params['breadcrumbs'][] = ['url'=>['/cms/admin/page/update','id'=>$page->id,'tab'=>'personal'],'label'=>'Страница'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-doctor-create">


    <?= $this->render('_form', [
        'model' => $model,
        'page' => $page,
    ]) ?>

</div>
