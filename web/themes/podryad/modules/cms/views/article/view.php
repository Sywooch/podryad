<?php
/**
 * @var $this \yii\web\View
 * @var $item \app\modules\cms\models\Article
 */
$this->title = $item->title;
?>
<main class="main">
    <section class="news-full-content">
        <h1>Новости</h1>
        <img src="<?=$item->imageSrc('275x214')?>" alt="" align="left">
        <strong><?=$item->title?></strong>
        <span><?=$item->date?></span>

        <?=$item->description?>
        <div class="news-full-content__social">Поделиться в социальных сетях<img src="<?= $this->theme->getUrl('static/images/content/social.jpg') ?>"
                                                                                 alt=""></div>
        <div class="news-full-content__comments"><img src="<?=$this->theme->getUrl('static/images/content/comments.jpg')?>" alt=""></div>
    </section>
    <?=$this->render('//layouts/_sidebar')?>
</main>