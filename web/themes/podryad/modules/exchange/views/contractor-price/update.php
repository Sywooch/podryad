<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\exchange\models\ContractorPrice */
?>
<main class="main">
<div class="create_album_container">
<div class="create_album__title">Добавить цены</div>
<div class="create_album__form ">
<?= $this->render('_form', ['model' => $model]) ?>
</div>
</div>
</main>