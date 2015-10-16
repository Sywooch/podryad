<?php
/** @var $model \app\modules\cms\models\form\Feedback */
/** @var $subject string */
?>
<h1><?=$subject?></h1>
<p>Имя: <?=$model->name?></p>
<p>Телефон: <?=$model->phone?></p>
<p>Email: <?=$model->email?></p>
<p>Сообщение: <?=$model->message?></p>