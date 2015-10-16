<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 16.10.15
 * Time: 12:50
 * @var $model \app\modules\cms\models\User
 * @var $subject string
 */
use yii\helpers\Url;
$link = Url::to(['/cms/users/restore', 'key' => $model->password_reset_token], true);
?>

<h1><?=$subject?></h1>

<p>
    Для создания нового пароля, вам нужно перейти по ссылке <?=\yii\helpers\Html::a($link,$link)?>
</p>