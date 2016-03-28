<?php
/**
 * @var $this \yii\web\View
 * @var $item \app\modules\cms\models\Article
 */
$this->title = $item->title;
$this->registerMetaTag(['name'=>'Description','content'=>$item->metaDescription]);
$this->registerMetaTag(['name'=>'Keywords','content'=>$item->metaKeywords]);

$this->title = !empty($title) ? $title : $item->title;
$this->params['breadcrumbs'] = [
    ['label'=>'Новости','url'=>['/cms/article/list','type'=>'news']],
    $item->title,
];


?>
<main class="main">
    <section class="news-full-content">
        <h1><?= $item->title ?></h1>
        <img src="<?=$item->imageSrc('275x214')?>" alt="" align="left">
        <span><?=$item->date?></span>

        <?=$item->description?>
        <div class="news-full-content__social">Поделиться в социальных сетях
            <script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script>
            <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small"
                 data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir"
                 data-yashareTheme="counter"></div>
        </div>
        <div class="news-full-content__comments">
<div id="disqus_thread"></div>
<script>
/**
* RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
* LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL; // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');

s.src = '//podryad.disqus.com/embed.js';

s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
        </div>
    </section>
    <?=$this->render('//layouts/_sidebar')?>
</main>