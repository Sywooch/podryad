<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 30.09.15
 * Time: 11:30
 *
 * @var $this \yii\web\View
 * @var $content string
 */
use yii\helpers\Url;
use yii\helpers\Html;
$this->beginPage();
\app\assets\AppAsset::register($this);
?>
    <!DOCTYPE html><!--[if IE 7]>
    <html class="ie7 lt-ie10 lt-ie9 lt-ie8 no-js" lang="ru"><![endif]-->
    <!--[if IE 8]>
    <html class="ie8 lt-ie10 lt-ie9 no-js" lang="ru"><![endif]-->
    <!--[if IE 9 ]>
    <html class="ie9 lt-ie10 no-js" lang="ru"><![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!-->
    <html class="no-js" lang="ru"><!--<![endif]-->
        <head>
            <meta charset="utf-8">
            <title><?=$this->title?></title>
            <?=$this->head()?>
            <?=Html::csrfMetaTags()?>
			
            <meta name="robots" content="noodp, noydir">
			<meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="HandheldFriendly" content="true">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
			<link rel="apple-touch-icon" sizes="57x57" href="themes/podryad/static/images/favicon/apple-icon-57x57.png">
				<link rel="apple-touch-icon" sizes="60x60" href="themes/podryad/static/images/favicon/apple-icon-60x60.png">
				<link rel="apple-touch-icon" sizes="72x72" href="themes/podryad/static/images/favicon/apple-icon-72x72.png">
				<link rel="apple-touch-icon" sizes="76x76" href="themes/podryad/static/images/favicon/apple-icon-76x76.png">
				<link rel="apple-touch-icon" sizes="114x114" href="themes/podryad/static/images/favicon/apple-icon-114x114.png">
				<link rel="apple-touch-icon" sizes="120x120" href="themes/podryad/static/images/favicon/apple-icon-120x120.png">
				<link rel="apple-touch-icon" sizes="144x144" href="themes/podryad/static/images/favicon/apple-icon-144x144.png">
				<link rel="apple-touch-icon" sizes="152x152" href="themes/podryad/static/images/favicon/apple-icon-152x152.png">
				<link rel="apple-touch-icon" sizes="180x180" href="themes/podryad/static/images/favicon/apple-icon-180x180.png">
				<link rel="icon" type="image/png" sizes="192x192"  href="themes/podryad/static/images/favicon/android-icon-192x192.png">
				<link rel="icon" type="image/png" sizes="32x32" href="themes/podryad/static/images/favicon/favicon-32x32.png">
				<link rel="icon" type="image/png" sizes="96x96" href="themes/podryad/static/images/favicon/favicon-96x96.png">
				<link rel="icon" type="image/png" sizes="16x16" href="themes/podryad/static/images/favicon/favicon-16x16.png">
				<link rel="manifest" href="themes/podryad/static/images/favicon/manifest.json">
				<meta name="msapplication-TileColor" content="#ffffff">
				<meta name="msapplication-TileImage" content="themes/podryad/static/images/favicon/ms-icon-144x144.png">
				<meta name="theme-color" content="#ffffff">
            <!--[if lt IE 9 ]>
            <meta content="no" http-equiv="imagetoolbar"><![endif]-->
            <!--[if IE 8 ]>
            <link href="<?=$this->theme->getUrl('static/css/main_ie8.min.css')?>" rel="stylesheet" type="text/css"><![endif]-->
            <!--[if IE 9 ]>
            <link href="<?=$this->theme->getUrl('static/css/main_ie9.min.css')?>" rel="stylesheet" type="text/css"><![endif]-->
            <!--[if (gt IE 9)|!(IE)]><!-->
            <link href="<?=$this->theme->getUrl('static/css/main.min.css')?>" rel="stylesheet" type="text/css">
            <!--<![endif]-->
            <meta property="og:title" content="default title">
            <meta property="og:title" content=""/>
            <meta property="og:url" content=""/>
            <meta property="og:description" content=""/>
            <meta property="og:image" content=""/>
            <meta property="og:image:type" content="image/jpeg"/>
            <meta property="og:image:width" content="500"/>
            <meta property="og:image:height" content="300"/>
            <meta property="twitter:description" content=""/>
			
            <link rel="image_src" href=""/>
			<link href="<?=$this->theme->getUrl('static/css/slick.css')?>" rel="stylesheet" type="text/css">
            <link rel="icon" type="image/png" href="<?=$this->theme->getUrl('favicon.ico')?>">
            <script>(function (H) {
                    H.className = H.className.replace(/\bno-js\b/, 'js')
                })(document.documentElement)</script>
            <!--[if lt IE 9 ]>
            <script src="<?=$this->theme->getUrl('static/js/separate-js/html5shiv-3.7.2.min.js')?>" type="text/javascript"></script>
            <meta content="no" http-equiv="imagetoolbar"><![endif]-->
        </head>
        <body>
            <?php $this->beginBody()?>
            <?=\app\modules\cms\widgets\Notice::widget()?>
            <header class="header mainpage">
                <div class="header__wrapper">
                    <a href="<?=Url::home()?>" title="" class="header__logo"></a>
                    <div class="header__content">

                        <div class="header-tender">
                            <?php if(\Yii::$app->user->isGuest){?>
                                <a href="#" title="" class="btn btn--tender _tender" data-click="modal" data-item="#enter">Объявить
                                    тендер
                                </a>
                               <!-- <div class="header-tender__text">
                                    <span>20 городов</span><span>354 подрядчика</span><span>231 тендер</span>
                                </div>-->
                            <?php }else if(\Yii::$app->user->identity->role != \app\modules\cms\models\User::ROLE_CONTRACTOR){?>
                                <a href="<?=Url::to(['/exchange/tender/create'])?>" title="" class="btn btn--tender">Объявить тендер</a>
                            <?php }?>
                        </div>

                        <div class="header-login">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <a href="#" title="" data-click="modal" data-item="#enter">Вход</a>
                                <span>/ </span>
                                <a href="#" title="" data-click="modal" data-item="#registration">Регистрация</a>
                            <?php else:?>
                                <a href="<?= Url::to(
                                    \Yii::$app->user->identity->role == \app\modules\cms\models\User::ROLE_CONTRACTOR ?
                                        ['/exchange/contractor/view','id'=>\Yii::$app->user->id] : ['/cms/users/view']) ?>" title="" >Мой профиль</a>
                                <span>/ </span>
                                <a href="<?=Url::to(['/site/logout'])?>" title="">Выход</a>
                            <?php endif ?>
                        </div>
                        <nav class="top-menu">
                            <div class="top-menu__item">
                                <a href="<?=Url::home()?>" title="" class="top-menu__link">Главная</a>
                                <span>Главная страница сайта</span></div>
                            <div class="top-menu__item">
                                <a href="<?=Url::to(['/exchange/tender'])?>" title="" class="top-menu__link">Тендеры</a>
                                <span>Заявки на ремонт и строительство</span></div>
                            <div class="top-menu__item">
                                <a title="" class="top-menu__link">Подрядчики</a>
                                <span>Страница подрядчиков </span>

                                <div class="top-menu-inside">
                                    <a href="<?= Url::to(['/exchange/contractor','specialization'=>'remont-i-otdelka']) ?>" title="" class="top-menu-inside__link">Ремонт и
                                        отделка
                                    </a>
                                    <a href="<?= Url::to(['/exchange/contractor', 'specialization' => 'stroitelstvo']) ?>" title="" class="top-menu-inside__link">Строительство</a>
                                </div>
                            </div>
                            <div class="top-menu__item">
                                <a href="<?=Url::to(['/cms/article/list','type'=>\app\modules\cms\models\Article::TYPE_NEWS_ALIAS])?>" title="" class="top-menu__link">Новости</a>
                                <span>Статьи, новости, акции</span></div>
                            <div class="top-menu__item">
                                <a href="#" data-click="modal" data-item="#back_hunter" title="" class="top-menu__link">
                                    Обратная связь
                                </a>
                                <span>Ваши предложения и отзывы</span></div>
                            <div class="top-menu__item">
                                <a href="<?= Url::to(['/cms/default/page', 'path' => 'faq']) ?>" title="" class="top-menu__link">
                                    FAQ
                                </a>
                                <span>Вопросы/ответы</span>
                            </div>
                        </nav>
                        <?=\app\modules\cms\widgets\City::widget()?>
                    </div>
                </div>
            </header>
            <?=$content?>
            <footer class="footer">
                <div class="footer__wrapper">
				<div class="cr">
                   <div class="footer_logo">
					 <a href="<?=Url::home()?>" title="" ><img src="<?=$this->theme->getUrl('static/images/content/footer_log.png')?>" /></a>
					 
				   </div>
				   <div class="footer_menu">
				    <nav class="top-menu footer-menu-container">
                            <div class="top-menu__item footer_m">
                                <a href="<?=Url::home()?>" title="" class="top-menu__link">Главная</a>
                                
                            </div>
                            <div class="top-menu__item footer_m">
                                <a href="<?=Url::to(['/exchange/tender'])?>" title="" class="top-menu__link">Тендеры</a>
                              
                            </div>
                            <div class="top-menu__item footer_m">
                                <a href="<?= Url::to(['/exchange/contractor','specialization'=>'remont-i-otdelka']) ?>" title="" class="top-menu__link footer_link">Ремонт и
                                        отделка</a>
                                
                            </div>
							<div class="top-menu__item footer_m">
<a href="<?= Url::to(['/exchange/contractor', 'specialization' => 'stroitelstvo']) ?>" title="" class="top-menu__link footer_link">Строительство</a>
                                
                            </div>
                            <div class="top-menu__item footer_m">
                                <a href="<?=Url::to(['/cms/article/list','type'=>\app\modules\cms\models\Article::TYPE_NEWS_ALIAS])?>" title="" class="top-menu__link">Новости</a>

                            </div>
                            <div class="top-menu__item footer_m">
                                <a href="#" data-click="modal" data-item="#back_hunter" title="" class="top-menu__link">
                                    Обратная связь
                                </a>

                            </div>
                            <div class="top-menu__item footer_m">
                                <a href="<?= Url::to(['/cms/default/page', 'path' => 'faq']) ?>" title="" class="top-menu__link">
                                    FAQ
                                </a>

                            </div>
                        </nav>
				   </div>
				   <div class="razrabotano">
					Разработано в <a href="http://astanacreative.kz/" target="_blanck">Astanacreative.kz</a>
				   </div>
				    <div class="uslovia_footer">
				 <a href="/cms/default/page?path=usloviya" target="_blanck">Условия использования сервиса </a>
				   </div>
			    </div>
                </div>
            </footer>
            <div id="enter" class="modal enter">
                <div class="modal__close">x</div>
                <div class="modal__title">Войти</div>
                <?=Html::beginForm(['/site/login'])?>
                    <label class="form__label">E-mail:</label>
                    <input type="email" value="" class="form__input" name="LoginForm[username]">

                    <label class="form__label">Пароль:</label>
                    <input type="password" value="" class="form__input" name="LoginForm[password]">
                    <input type="hidden" name="LoginForm[rememberMe]" value="0"/>
                   <div class="zaponit"> <input type="checkbox" name="LoginForm[rememberMe]" id="rememberMe" value="1" checked="checked"/> <label for="rememberMe">запомнить</label></div>
                    <input type="submit" value="Войти" class="form__submit">

                    <a href="#" title="" data-click="modal" data-item="#registration">Регистрация</a>
                    <a href="<?= \yii\helpers\Url::to(['/cms/users/remind']) ?>" title="">Забыли пароль?</a>
                <?=Html::endForm()?>
            </div>
            <div id="registration" class="modal registration">
                <div class="modal__close">x</div>
                <div class="modal__title">Регистрация</div>
                <a href="#" title="" data-click="modal" data-item="#registration-customer" class="registration__item">Я
                    — заказчик<span>Я собираюсь объявить тендер и выбрать подходящего мастера</span></a>
                <a href="<?= Url::to(['/cms/users/register','scenario'=>\app\modules\cms\models\User::ROLE_CONTRACTOR]) ?>" title=""
                   class="registration__item">Я — подрядчик<span>Я собираюсь разместить информацию о себе и участвовать в тендерах</span>
                </a>
            </div>

            <div id="inviteToTenderWindow" class="modal _inviteToTenderWindow">
                <div class="modal__close">x</div>
                <div id="inviteToTenderBody">

                </div>
            </div>
            <?=\app\modules\cms\widgets\RegisterForm::widget()?>
            <?=\app\modules\cms\widgets\Feedback::widget()?>
            <div class="mask"></div>
            <?php $this->endBody() ?>

            <script src="http://cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>
            <script src="<?=$this->theme->getUrl('static/js/separate-js/jquery.swipebox.min.js')?>"></script>
            <script src="<?=$this->theme->getUrl('static/js/separate-js/nouislider.min.js')?>"></script>
            <script src="<?=$this->theme->getUrl('static/js/separate-js/jquery.cookie.js')?>"></script>
            <script src="<?=$this->theme->getUrl('static/js/main.js')?>"></script>
            <!-- Yandex.Metrika counter -->
            <script type="text/javascript"> (function (d, w, c) {
                    (w[c] = w[c] || []).push(function () {
                        try {
                            w.yaCounter33215163 = new Ya.Metrika({
                                id: 33215163,
                                clickmap: true,
                                trackLinks: true,
                                accurateTrackBounce: true,
                                webvisor: true,
                                trackHash: true
                            });
                        } catch (e) {
                        }
                    });
                    var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () {
                        n.parentNode.insertBefore(s, n);
                    };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = "https://mc.yandex.ru/metrika/watch.js";
                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else {
                        f();
                    }
                })(document, window, "yandex_metrika_callbacks");</script>
            <noscript>
                <div><img src="https://mc.yandex.ru/watch/33215163" style="position:absolute; left:-9999px;" alt=""/>
                </div>
            </noscript>
            <!-- /Yandex.Metrika counter -->
            <script>
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                ga('create', 'UA-55869135-17', 'auto');
                ga('send', 'pageview');

            </script>
        </body>
<?php $this->endPage()?>
    </html>