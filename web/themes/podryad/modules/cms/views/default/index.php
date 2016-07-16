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
$this->registerMetaTag(['name' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['name' => 'og:description', 'content' => $settings['description']]);
$this->registerMetaTag(['name' => 'twitter:description', 'content' => $settings['description']]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $settings['keywords']]);
$this->registerMetaTag(['name' => 'description', 'content' => $settings['description']]);
?>
<section class="main-img">
    <div class="main-img__content">
        <div class="main-img__title">Найдите своего Подрядчика не выходя из дома!</div>
        <a href="#" title="" data-click="modal" data-item="#specialization" class="btn btn--search">Выбрать
            специализации
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
            <h1>Поиск подрядчиков для ремонта квартир, строительства домов и не только!</h1>

            <p>Хотите сделать <a href="http://podryad.kz/exchange/contractor/remont-i-otdelka" target="_blank" title="Каталог компаний Казахстана по ремонту квартир" style=" color:#1884bf;font-size:16px; ">ремонт квартиры</a> или заказать <a href="http://podryad.kz/exchange/contractor/stroitelstvo" title="Каталог строительных компаний Казахстана" target="_blank" style=" color:#1884bf;font-size:16px; ">строительство дома под ключ</a>? Ищите у кого заказать дизайн интерьера? Вам нужна услуга «муж на час» или ремонт стиральных машин на дому в Вашем городе? С этим и многим другим Вам поможет строительный портал Podryad.kz. Podryad.kz – это сервис, помогающий быстро найти подрядчика для выполнения любых ремонтных и строительных работ.
            </p>
            <p>Строительный сайт Podryad.kz сделает Ваш поиск подрядчика простым и удобным. Для Вашего внимания на нашем сайте зарегистрировано большое количество строительных компаний Астаны, Алматы и других городов Казахстана, готовые выполнить Ваш заказ. Портфолио с фотографиями выполненных строительных, ремонтных работ и реальные отзывы людей помогут Вам сделать правильный выбор.
            </p>
            <p>Мы не берем никаких комиссий или процентов ни с подрядчиков, ни с заказчиков. Никаких подводных камней. Пользователи нашего сайта сами связываются со строительными компаниями по указанным в их профилях контактам. 
            </p>
            <p>Для тех пользователей, которые хотят сэкономить время, а возможно и деньги, на сайте есть функция «Объявить  тендер». Опишите объем работ, укажите Ваш бюджет или пусть он будет договорным – заинтересованные строительные фирмы оставят Вам свои ценовые предложения.
            </p>
            <p>Сервис Podryad.kz дает возможность подрядчикам увеличить количество клиентов или найти выгодный строительный тендер. Для этого Вам нужно пройти несколько простых шагов: создать и оформить Вашу страничку на сайте, загрузить фотографии выполненных Вами работ, указать контактную информацию. Также, регистрация позволяет Вам участвовать в тендерах. 
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