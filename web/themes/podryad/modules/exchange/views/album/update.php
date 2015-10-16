<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\exchange\models\Album */
use yii\bootstrap\Tabs;
?>
<h1>album/update</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

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