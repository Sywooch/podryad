<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 30.09.15
 * Time: 11:30
 * @var $this \yii\web\View
 */

use yii\helpers\Url;
use app\modules\cms\models\Settings;

$settings = [
    'title' => Settings::get('index', 'metaTitle'),
    'keywords' => Settings::get('index', 'metaKeywords'),
    'description' => Settings::get('index', 'metaDescription'),
];

$this->title = !empty($settings['title']) ? $settings['title'] : 'Главная';
$this->registerMetaTag(['name' => 'keywords', 'content' => $settings['keywords']]);
$this->registerMetaTag(['name' => 'description', 'content' => $settings['description']]);
?>
<section class="main-img">
    <div class="main-img__content">
        <div class="main-img__title">Найдите своего Подрядчика не выходя из дома!</div>
        <a href="#" title="" data-click="modal" data-item="#specialization" class="btn btn--search">Выбрать
            специализацию
        </a>
        <?=\yii\helpers\Html::beginForm(['/exchange/contractor' ],'get',['id'=>'main-specialization-form'])?>
        <?=\app\modules\cms\widgets\Specialization::widget(['modelName'=>'Contactor'])?>
        <?=\yii\helpers\Html::endForm()?>
    </div>
</section>
<main class="main">
    <div class="main-content">
        <div class="search-contractor">
            <div class="search-contractor-block">
                <div class="search-contractor__title">РЕМОНТ И ОТДЕЛКА</div>
                <div class="search-contractor__img search-contractor__img--repair"></div>
                <a href="<?= Url::to(['/exchange/contractor', 'specialization' => 'remont-i-otdelka']) ?>" title="" class="search-contractor__btn">НАЙТИ подрядчика
                    для РЕМОНТа<span>от левкаса до дизайнерского ремонта</span></a>
            </div>
            <div class="search-contractor-block">
                <div class="search-contractor__title">СТРОИТЕЛЬСТВО</div>
                <div class="search-contractor__img search-contractor__img--build"></div>
                <a href="<?= Url::to(['/exchange/contractor', 'specialization' => 'stroitelstvo']) ?>" title="" class="search-contractor__btn button_search">НАЙТИ подрядчика для СТРОИТельстВа<span>от забора до жилого дома</span>
                </a>
            </div>
        </div>
        <div class="service">
            <div class="service__title">КАК УСТРОЕН СЕРВИС?</div>
            <div class="service-block service-block--n1">
                <span class="service-block__link">Добавьте тендер</span>
                <div class="service-block__text">Разместите тендер и получите предложения от заинтересовавшихся подрядчиков. Вы можете сами приглашать понравившихся подрядчиков участвовать в Вашем тендере
                </div>
            </div>
            <div class="service-block service-block--n2">
                <span href="#" title="" class="service-block__link">Изучите предложения</span>
                <div class="service-block__text">Заинтересовавшиеся подрядчики оставят свои предложения. Вы можете оценить подрядчиков по портфолио и отзывам на их страничке
                </div>
            </div>
            <div class="service-block service-block--n3">
                <span href="#" title="" class="service-block__link">Выберите исполнителя</span>
                <div class="service-block__text">Выберите подрядчика, оставившего наиболее подходящее для Вас предложение - это откроет ему Ваши контакты
                </div>
            </div>
            <div class="service-block service-block--n4">
                <span href="#" title="" class="service-block__link">Оцените работу</span>
                <div class="service-block__text">После окончания работ оставьте отзыв о подрядчике на его страничке. Ваш отзыв поможет другим заказчикам сделать правильный выбор
                </div>
            </div>
            <div class="service__bottom">
                <?php if (\Yii::$app->user->isGuest) { ?>
                    <a href="#" title="" class="btn btn--tender _tender" data-click="modal" data-item="#enter">Объявить
                        тендер
                    </a>
                <?php } else if (\Yii::$app->user->identity->role != \app\modules\cms\models\User::ROLE_CONTRACTOR) { ?>
                    <a href="<?= Url::to(['/exchange/tender/create']) ?>" title="" class="btn btn--tender">Объявить
                        тендер
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="seo-text">
            <h1>Для кого и чего нужен сервис PODRYAD.KZ?</h1>

            <p>Ремонт и строительство - то, с чем мы сталкиваемся повсеместно. Вокруг нас постоянно что-то строится -
                жилые дома, офисы, торговые центры, заводы, магазины и т.п. Все мы периодически делаем ремонт, стараемся
                улучшить наши жилищные условия. В этих процессах почти всегда присутствуют 2 стороны: те, кто поручают
                (Заказчики) и те, кто эти поручения исполняют (Подрядчики).
            </p>
            <p>Сервис PODRYAD.KZ полезен и удобен для обеих сторон. Если Вы Заказчик и хотите сделать ремонт
                (косметический, дизайнерский, евроремонт и т.п.) или Вам необходимо найти подрядчика на строительные
                работы (коттедж, забор, мощение улиц, предприятие и т.п.), PODRYAD.KZ сделает Ваш поиск подрядчика
                простым и удобным. Для Вашего внимания на нашем сайте зарегистрировано огромное количество подрядчиков,
                готовых выполнить Ваш заказ. Портфолио с фотографиями, выполненных строительных/ремонтных работ и
                реальные отзывы людей помогут Вам сделать правильный выбор. Сервис PODRYAD.KZ полезен и удобен для обеих
                сторон. Если Вы Заказчик и хотите сделать ремонт (косметический, дизайнерский, евроремонт,
                перепланировку) или Вам необходимо найти подрядчика на строительные работы, PODRYAD.KZ сделает ваш поиск
                подрядчика простым и удобным. Для Вашего внимания на нашем сайте зарегистрировано огромное количество
                подрядчиков, готовые выполнить ваш заказ. Портфолио с фотографиями, выполненных строительных/ремонтных
                работ и реальные отзывы людей помогут Вам сделать правильный выбор. Для того, чтобы еще больше
                сэкономить Ваше время, PODRYAD.KZ предлагает функцию "Объявить Тендер". Опишите объем работ, укажите Ваш
                бюджет или оставьте его неопределенным - заинтересованные подрядчики оставят Вам свои ценовые
                предложения.
            </p>
            <p>Подрядчикам сервис помогает увеличить количество клиентов для ремонта и отделки или найти выгодный
                строительный подряд. Для этого Вам нужно пройти несколько простых шагов: создать и оформить Вашу
                страничку на сайте, загрузить фотографии выполненных Вами работ. Также, зарегистрировавшись, вы можете
                оставлять предложения на объявленные заказчиками тендеры.
            </p>
            <p>
                Сервис PODRYAD.KZ является абсолютно БЕСПЛАТНЫМ для всех!
            </p>
        </div>
		<div class="video_site">
		<div class="service__title video">посмотрите наше видео</div>
		<div class="video_container" id="video"><iframe src="https://player.vimeo.com/video/145724779?color=ffffff&title=0&byline=0&portrait=0" width="591" height="332" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		</div>
		</div>
    </div>
    <?= $this->render('//layouts/_sidebar') ?>
</main>