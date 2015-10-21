<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\exchange\models\Album*/
?>
<main class="main">
<div class="create_album_container">
<div class="create_album__title">Добавить альбом</div>
<div class="create_album__form">
<?=$this->render('_form',['model'=>$model])?>
</div>
</div>
</main>