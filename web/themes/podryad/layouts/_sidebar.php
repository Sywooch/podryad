<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 30.09.15
 * Time: 12:00
 */
use app\modules\cms\models\Article;
?>
<aside class="sidebar">
    <div class="sidebar-news">
        <div class="sidebar-news__title">Новости</div>

        <?php if( ($item=Article::getOneByCategory(Article::TYPE_STOCK_ALIAS)) ):?>
        <div class="sidebar-news-block">
            <div class="sidebar-news-block__img">
                <img src="<?= $item->imageSrc('86x86') ?>" alt="<?= $item->title ?>">
            </div>
            <div class="sidebar-news-block__content">
                <a href="<?= $item->path ?>" title="" class="sidebar-news-block__link"><?= $item->title ?></a>
                <p class="sidebar-news-block__text"><?= strip_tags($item->shortext(300)) ?></p>
            </div>
        </div>
        <?php endif?>

        <?php foreach(Article::getAllByCategory(Article::TYPE_NEWS_ALIAS,2) as $item):?>
        <div class="sidebar-news-block">
            <div class="sidebar-news-block__img">
                <img src="<?=$item->imageSrc('86x86')?>" alt="<?=$item->title?>">
            </div>
            <div class="sidebar-news-block__content">
                <a href="<?=$item->path?>" title="" class="sidebar-news-block__link"><?=$item->title?></a>
                <p class="sidebar-news-block__text"><?=strip_tags($item->shortext(300))?></p>
            </div>
        </div>
        <?php endforeach?>
    </div>
    <div class="sidebar-vk"><img src="<?=$this->theme->getUrl('static/images/content/vk.jpg')?>" alt=""></div>
</aside>