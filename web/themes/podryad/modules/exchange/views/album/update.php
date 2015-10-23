<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\exchange\models\Album */
use yii\bootstrap\Tabs;
?>
<main class="main">
<div class="create_album_container">
<div class="create_album__title">Добавить цены</div>
<div class="create_album__form">
<?php

echo Tabs::widget([
    'items' => [
        [
            'label' => 'Альбом',
            'content' => $this->render('_form', ['model' => $model]),
            'active' => true
        ],
        [
            'label' => 'Фотографии',
            'content' => \app\modules\cms\widgets\ImageUpload::widget(['model' => $model, 'primaryKey' => $model->id, 'maxNumberOfFiles' => 100]),
            'active' => false
        ],
    ],
]);?>
</div>
</div>
</main>