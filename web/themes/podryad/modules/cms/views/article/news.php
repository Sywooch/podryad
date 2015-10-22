<?php
/**
 * @var $this \yii\web\View
 * @var $item \app\modules\cms\models\Article
 * @var $items \app\modules\cms\models\Article[]
 */
use app\modules\cms\models\Article;
$this->title = $item->typeView;
$breadcrumbs = [];
?>
<main class="main">
    <section class="news-content">
        <div class="news-content__title">НОВОСТИ</div>
<ul >
        <?php if (($row = Article::getOneByCategory(Article::TYPE_STOCK_ALIAS))): ?>
            
			<li class="news-content-item">
                <img src="<?= $row->imageSrc('275x214') ?>" alt="<?= $item->title ?>">

                <a href="<?= $row->path ?>"><?= $row->title ?></a>
                <span><?= $row->date ?></span>
            </li>
			
        <?php endif?>

        <?php foreach ($items as $row): ?>
        <li class="news-content-item">
            <img src="<?= $row->imageSrc('275x214')?>" alt="<?=$item->title?>">
            <a href="<?=$row->path?>"><?= $row->title?></a>
            <span><?= $row->date?></span>
        </li>
        <?php endforeach ?>
		</ul>
    </section>
    <?=$this->render('//layouts/_sidebar')?>
</main>