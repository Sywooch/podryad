<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\exchange\models\Album */
use yii\bootstrap\Tabs;
?>

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