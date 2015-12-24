<?php
/**
 * @var $model \app\modules\cms\models\User
 */
?>
<h1>Регистрация на сайте <?=APP_NAME?></h1>
<p>
    Благодарим за регистрацию на сайте <?=APP_NAME?>
</p>
<h2>Ваши персональные данные:</h2>
<ul>
    <li>
        <strong>Логин:</strong>
        <?=$model->username?>
    </li>
    <li>
        <strong>Пароль:</strong>
        <?= $model->password2 ?>
    </li>
    <li>
        <strong>Ф.И.О:</strong>
        <?= $model->profile->fio ?>
    </li>
    <li>
        <strong>Телефон:</strong>
        <?= $model->profile->phone ?>
    </li>
</ul>