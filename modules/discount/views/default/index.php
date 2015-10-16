<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\LinkPager;
$title = 'Главная';
$this->title = $title;
?>
<div class="cr">
    <div class="slid_banner">
        <div class="slid_schetchik">
            <div class="slid">
                <div class="slider_container">
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <img src="<?=Url::base()?>/site/images/slider/slide1.jpg" alt="" title=""/>
                            </li>
                            <li>
                                <img src="<?=Url::base()?>/site/images/slider/slide1.jpg" alt="" title=""/>
                            </li>
                            <li>
                                <img src="<?=Url::base()?>/site/images/slider/slide1.jpg" alt="" title=""/>
                            </li>
                            <li>
                                <img src="<?=Url::base()?>/site/images/slider/slide1.jpg" alt="" title=""/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="schetchik">
                <div class="schet">
                    <div class="karta_schet">
                        <div class="timer">
                            <span>1043</span>
                        </div>
                        <p>Клиентов</p>
                    </div>
                    <div class="karta_priobresti">
                        <div class="timer">
                            <span>4043</span>
                        </div>
                        <p>Партнеров</p>
                    </div>
                </div>
                <a href="<?=Url::to(['/discount/default/request','type'=>'client'])?>" target="_blank" class="button1"></a>
            </div>
        </div>
        <div class="banner_border">
            <div class="banner">
                <img src="<?=Url::base()?>/site/img/banner.jpg" alt="" title=""/>
            </div>
        </div>
    </div>
    <div class="content_osnovnoi">
        <div class="title">
            <h1>Скидки</h1>

            <p>Любой текст</p>

            <div class="soc_seti glav">
                <?=\Yii::$app->params['socShare']?>
            </div>
        </div>
        <div class="content">
            <ul class="glavnaia">
                <?php foreach($items as $item) echo $this->render('_serviceCard',['model'=>$item])?>
            </ul>

            <div class="page_schet">

                <?= LinkPager::widget([
                    'pagination' => $pages,
                    'prevPageCssClass'=>'pager-previo',
                    'lastPageCssClass'=>'last',
                    'nextPageCssClass'=>'pager-next',
                ]) ?>
            </div>
            <div class="map_vk">
                <div class="map_bg">
                    <?=\app\modules\cms\components\yandexMap\Map::widget(['points'=>\app\modules\discount\models\Partner::getMapPoints()])?>
                </div>
                <div class="vk">
                    <script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>

                    <!-- VK Widget -->
                    <div id="vk_groups"></div>
                    <script type="text/javascript">
                        VK.Widgets.Group("vk_groups", {mode: 0, width: "220", height: "400", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 95056247);
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>