<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="error">
    <img src="<?=$this->theme->getUrl('static/images/content/404.png')?>">

    <p>К сожалению, страница, которую вы ищете, не существует.</br>
        Вы набрали не правильный адрес старницы.Пожалуйста перейдите на
        <a href="<?=\yii\helpers\Url::home()?>">главную страницу.</a>
    </p>

    <?php if (YII_DEBUG): ?>
       <p><?= $message ?></p>
    <?php endif; ?>
</div>
</main>
