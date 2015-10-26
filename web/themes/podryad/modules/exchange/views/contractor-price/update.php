<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\exchange\models\ContractorPrice */
?>
<main class="main">
<div class="create_album_container">
<div class="create_album__title">Редактирование цены</div>
<div class="create_album__form ">

    <a href="<?= \yii\helpers\Url::to(['/exchange/contractor/view', 'id' => $model->userId]) ?>" title=""
       class="contractor-back">Вернуться в профиль
    </a>
    <br/><br/>

<?= $this->render('_form', ['model' => $model]) ?>
</div>
</div>
</main>