<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 30.09.15
 * Time: 11:30
 * @var $this \yii\web\View
 */

use yii\helpers\Url;

$this->title = 'Главная';
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
                <a href="<?= Url::to(['/exchange/contractor', 'specialization' => 'stroitelstvo']) ?>" title="" class="search-contractor__btn">НАЙТИ подрядчика для СТРОИТельстВа<span>от забора до жилого дома</span>
                </a>
            </div>
        </div>
        <div class="service">
            <div class="service__title">КАК УСТРОЕН СЕРВИС?</div>
            <div class="service-block service-block--n1">
                <a href="#" title="" class="service-block__link">Добавьте тендер</a>
                <div class="service-block__text">Вы можете выбрать мастеров и пригласить их участвовать в
                    тендере, или просто разместить тендер и получить предложения от заинтересовавшихся
                    мастеров.
                </div>
            </div>
            <div class="service-block service-block--n2">
                <a href="#" title="" class="service-block__link">Изучите предложения</a>
                <div class="service-block__text">Заинтересовавшиеся мастера оставят свои предложения на
                    выполнение работ. Вы сможете оценить мастеров на основании рейтинга, портфолио и
                    отзывов.
                </div>
            </div>
            <div class="service-block service-block--n3">
                <a href="#" title="" class="service-block__link">Выберите исполнителя</a>
                <div class="service-block__text">Выберите предложение наиболее подходящего мастера. При
                    назначении Реального мастера исполнителем, Real Master бесплатно предоставит страховку
                    на сумму выполненных работ.
                </div>
            </div>
            <div class="service-block service-block--n4">
                <a href="#" title="" class="service-block__link">Оцените работу</a>
                <div class="service-block__text">После выполнения необходимых работ оставьте отзыв о
                    мастере. Ваш отзыв повлияет на рейтинг мастера и поможет другим заказчикам принять
                    верное решение при выборе исполнителя.
                </div>
            </div>
            <div class="service__bottom">
                <a href="<?= Url::to(['/exchange/tender']) ?>" title="" class="btn btn--tender">ОБЪЯВИТЬ ТЕНДеР</a>
            </div>
        </div>
        <div class="seo-text">
            <h1>НАЗВАНИЕ РАЗДЕЛА</h1>

            <p>С другой стороны укрепление и развитие структуры требуют от нас анализа дальнейших
                направлений развития. Не следует, однако забывать, что укрепление и развитие структуры
                позволяет оценить значение новых предложений. Задача организации, в особенности же
                постоянный количественный рост и сфера нашей активности позволяет оценить значение
                направлений прогрессивного развития. Идейные соображения высшего порядка, а также постоянный
                количественный рост и сфера нашей активности в значительной степени обуславливает создание
                позиций, занимаемых участниками в отношении поставленных задач. С другой стороны
                консультация с широким активом играет важную роль в формировании дальнейших направлений
                развития.
            </p>
            <p>Товарищи! постоянное информационно-пропагандистское обеспечение нашей деятельности требуют от
                нас анализа систем массового участия. Таким образом рамки и место обучения кадров позволяет
                выполнять важные задания по разработке модели развития. Разнообразный и богатый опыт
                консультация с широким активом требуют от нас анализа модели развития. Идейные соображения
                высшего порядка, а также начало повседневной работы по формированию позиции позволяет
                выполнять важные задания по разработке форм развития. С другой стороны укрепление и развитие
                структуры влечет за собой процесс внедрения и модернизации системы обучения кадров,
                соответствует насущным потребностям. Повседневная практика показывает, что новая модель
                организационной деятельности требуют определения и уточнения существенных финансовых и
                административных условий.
            </p>
            <p>Повседневная практика показывает, что начало повседневной работы по формированию позиции
                позволяет выполнять важные задания по разработке модели развития. Не следует, однако
                забывать, что укрепление и развитие структуры в значительной степени обуславливает создание
                систем массового участия...
            </p>
        </div>
    </div>
    <?= $this->render('//layouts/_sidebar') ?>
</main>