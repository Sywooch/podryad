<?php
/**
 * @var $this \yii\web\View
 * @var $item \app\modules\cms\models\Article
 * @var $items \app\modules\cms\models\Article[]
 */

use app\modules\cms\models\Article;
use app\modules\cms\models\Settings;
use yii\widgets\Breadcrumbs;

$title = Settings::get('news','metaTitle');

$this->title =!empty($title) ? $title : $item->typeView;
$this->params['breadcrumbs'] = [
    $item->typeView,
];

$this->registerMetaTag(['name' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['name' => 'og:description', 'content' => Settings::get('news', 'metaDescription')]);
$this->registerMetaTag(['name' => 'twitter:description', 'content' => Settings::get('news', 'metaDescription')]);
$this->registerMetaTag(['name' => 'keywords', 'content' => Settings::get('news', 'metaKeywords')]);
$this->registerMetaTag(['name' => 'description', 'content' => Settings::get('news', 'metaDescription')]);
?>
<main class="main">
    <section class="news-content">
        <div class="news-content__title"><?= $item->typeView?></div>
<ul >
        <?php if (($row = Article::getOneByCategory(Article::TYPE_STOCK_ALIAS))): ?>
            
			<li class="news-content-item asd">
				<div class="news-content-img">
               <a href="<?= $row->path ?>" title="<?= $row->title ?>"> <img src="<?= $row->imageSrc('275x214') ?>" alt="<?= $item->title ?>"></a>
				</div>
                <a href="<?= $row->path ?>"><?= $row->title ?></a>
                <span><?= $row->date ?></span>
            </li>
			
        <?php endif?>

        <?php foreach ($items as $row): ?>
        <li class="news-content-item">
			  <div class="news-content-img">
			  <a href="<?= $row->path ?>"  title="<?= $row->title ?>"> 
            <img src="<?= $row->imageSrc('275x214')?>" alt="<?=$item->title?>"></a>
			</div>
            <a href="<?=$row->path?>"><?= $row->title?></a>
            <span><?= $row->date?></span>
        </li>
        <?php endforeach ?>
		</ul>
    </section>
    <?=$this->render('//layouts/_sidebar')?>
</main>