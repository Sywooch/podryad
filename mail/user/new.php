<?php
/**
 * @var $model \app\modules\cms\models\User
 */
?>
<h1>Зарегистрирован новый пользователь на сайте <?=APP_NAME?></h1>
<p>
    Для просмотра и активации пользователя,
    <a href="<?=\yii\helpers\Url::to(['/cms/admin/user/update','id'=>$model->id],true)?>">перейдите по ссылке</a>
</p>