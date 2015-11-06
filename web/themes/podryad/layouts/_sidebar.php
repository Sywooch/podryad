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
             <a href="<?= $item->path ?>">   <img src="<?= $item->imageSrc('86x86') ?>" alt="<?= $item->title ?>"></a>
            </div>
            <div class="sidebar-news-block__content">
                <a href="<?= $item->path ?>" title="" class="sidebar-news-block__link"><?= $item->title ?></a>
                <p class="sidebar-news-block__text"><?= strip_tags($item->shortext(300)) ?></p>
            </div>
        </div>
        <?php endif?>

        <?php foreach(Article::getAllByCategory(Article::TYPE_NEWS_ALIAS,4) as $item):?>
        <div class="sidebar-news-block">
            <div class="sidebar-news-block__img">
               <a href="<?= $item->path ?>">  <img src="<?=$item->imageSrc('86x86')?>" alt="<?=$item->title?>"></a>
            </div>
            <div class="sidebar-news-block__content">
                <a href="<?=$item->path?>" title="" class="sidebar-news-block__link"><?=$item->title?></a>
                <p class="sidebar-news-block__text"><?=strip_tags($item->shortext(300))?></p>
            </div>
        </div>
        <?php endforeach?>
    </div>
    <div class="sidebar-vk">
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?117"></script>

        <!-- VK Widget -->
        <div id="vk_groups"></div>
        <script type="text/javascript">
            VK.Widgets.Group("vk_groups", {
                mode: 0,
                width: "318",
                height: "400",
                color1: 'FFFFFF',
                color2: '2B587A',
                color3: '5B7FA6'
            }, 105009611);
        </script>
    </div>
</aside>