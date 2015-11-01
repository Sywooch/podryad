<?php
/**
 * @var $this \yii\web\View
 * @var $item \app\modules\cms\models\Article
 */
$this->title = $item->title;
$this->registerMetaTag(['name'=>'Description','content'=>$item->metaDescription]);
$this->registerMetaTag(['name'=>'Keywords','content'=>$item->metaKeywords]);
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
            <div id="hypercomments_widget"></div>
            <script type="text/javascript">
                _hcwp = window._hcwp || [];
                _hcwp.push({widget: "Stream", widget_id: 65620});
                (function () {
                    if ("HC_LOAD_INIT" in window)return;
                    HC_LOAD_INIT = true;
                    var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en").substr(0, 2).toLowerCase();
                    var hcc = document.createElement("script");
                    hcc.type = "text/javascript";
                    hcc.async = true;
                    hcc.src = ("https:" == document.location.protocol ? "https" : "http") + "://w.hypercomments.com/widget/hc/65620/" + lang + "/widget.js";
                    var s = document.getElementsByTagName("script")[0];
                    s.parentNode.insertBefore(hcc, s.nextSibling);
                })();
            </script>
            <a href="http://hypercomments.com" class="hc-link" title="comments widget">comments powered by
                HyperComments
            </a>
        </div>
    </section>
    <?=$this->render('//layouts/_sidebar')?>
</main>