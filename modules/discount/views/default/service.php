<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\discount\models\Service */
$title = $model->title;
$this->title = $title;
?>

<div class="cr">
    <?php if( ($sliders=$model->images) ):?>
    <div class="slid_banner">
        <div class="slid">
            <div class="slider_container">
                <div class="flexslider">
                    <ul class="slides">
                        <?php foreach ($sliders as $image): ?>
                            <li>
                                <img src="<?= $image->resize('819x324') ?>" alt="" title=""/>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif?>
        <div class="content_osnovnoi">

            <div class="content">
                <h1><?=$title?></h1>
                <b>Скидка: </b><?=$model->discount?>%
                <?php if( ($desctiption = $model->description) ):?>
                <div class="o_clube_txt">
                    <?=$desctiption?>
                </div>
                <?php endif?>
                <div class="map_vk card_underline">
                    <div class="contact_card">
                        <div class="contact">
                            <p><span>Наш сайт</span>- <?= $model->category->site ?></p>

                            <p><span>Телефоны</span>- <?= $model->category->phones ?></p>

                            <p><span>Время работы</span>- <?= $model->category->workTime ?></p>

                            <p><span>Адрес</span>- <?= $model->category->address ?></p>
                        </div>
                        <div class="card">
                            <a href="<?=Url::to(['/discount/default/request','type'=>'client'])?>">
                                <img src="<?= Url::base() ?>/site/img/card.png" alt="" title=""/>
                            </a>
                        </div>
                    </div>
                    <div class="map_bg">
                        <?=\app\modules\cms\components\yandexMap\Map::widget(['model'=>$model->category,'attribute'=>'cords'])?>
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
                <div class="title">
                    <h1>О компании:</h1>

                    <p><?= $model->category->description ?></p>
                </div>
                <ul class="glavnaia">
                    <?php foreach ($model->siblings as $sibling) echo $this->render('_serviceCard', ['model' => $sibling]) ?>
                </ul>
            </div>
        </div>
    </div>
</div>