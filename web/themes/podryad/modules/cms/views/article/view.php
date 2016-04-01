<?php
/**
 * @var $this \yii\web\View
 * @var $item \app\modules\cms\models\Article
 */
$this->title = $item->title;
$this->registerMetaTag(['name' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['name' => 'og:description', 'content' => $item->metaDescription]);
$this->registerMetaTag(['name' => 'twitter:description', 'content' => $item->metaDescription]);
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
            <div id="mc-container"></div>
            <script type="text/javascript">
                cackle_widget = window.cackle_widget || [];
                cackle_widget.push({widget: 'Comment', id: 43378});
                (function () {
                    var mc = document.createElement('script');
                    mc.type = 'text/javascript';
                    mc.async = true;
                    mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(mc, s.nextSibling);
                })();
            </script>
        </div>
    </section>
    <?=$this->render('//layouts/_sidebar')?>
</main>