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
                                <div class="header-tender__text">
                                    <span>20 городов</span><span>354 подрядчика</span><span>231 тендер</span>
                                </div>
                            <?php }else if(\Yii::$app->user->identity->role != \app\modules\cms\models\User::ROLE_CONTRACTOR){?>
                                <a href="<?=Url::to(['/exchange/tender/create'])?>" title="" class="btn btn--tender">Объявить тендер</a>
                                <div class="header-tender__text"><span>20 городов</span><span>354 подрядчика</span><span>231 тендер</span>
                                </div>
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
                                        ['/exchange/contractor/view','id'=>\Yii::$app->user->id] : ['/cms/users/view']) ?>" title="" >Профиль</a>
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
                                <span>Заявки на ремонт и строительство</span>

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
                    <p>Название компании © 2015 год</p>
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
                    <input type="checkbox" name="LoginForm[rememberMe]" id="rememberMe"/> <label for="rememberMe">запомнить</label>
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
        </body>
<?php $this->endPage()?>
    </html>