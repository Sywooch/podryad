<?php
/* @var $this \yii\web\View */
/* @var $model \app\modules\discount\models\Request */
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$title = 'Как получить карту';
$this->title = $title;
?>
<div class="title">
    <h1><?=$title?></h1>
    <p>Любой текст</p>
    <ul class="under_ul">
        <li><a href="/">Главная <i class="fa fa-angle-right"></i></a></li>
        <li><a href="">Как получить карту</a></li>
    </ul>
    <div class="soc_seti turizm">
        <?=\Yii::$app->params['socShare']?>
    </div>
</div>
<div class="content">
    <div class="o_clube_txt">
        <p>Если вы еще не являетесь участником дисконтного клуба «Радуга Скидок», то мы рекомендуем вам немедленно присоединиться к нам! С каждой покупкой вы теряете скидки, которыми могли бы воспользоваться, имея при себе дисконтную карту «Радуга Скидок»! </p>
    </div>
    <div class="card_txt">
        <h2>Как получить единую клубную карту «Радуга Скидок»?</h2>
        <p>Чтобы участвовать в розыгрышах призов и получать скидки при совершении покупок в компаниях-участниках дисконтного клуба «Радуга Скидок» - у Вас на руках должна быть клубная карта «Радуга Скидок». Единая клубная карта «Радуга Скидок» - это возможность приобретать товары и услуги в магазинах и компаниях со скидками до 50%. Затраты на приобретение клубной карты окупятся уже через 1-3 применения карты, после чего Вы будете только экономить. Использовать карту можете не только Вы, но и все члены Вашей семьи, друзья и знакомые. </p>
    </div>
    <div class="poluchenie_card">
        <h2>В настоящее время клубную карту «Радуга Скидок» можно получить следующим образом:</h2>
        <p>1. Вы можете заказать клубную карту оставить электронную заявку по форме ниже и наши консультанты свяжутся с Вами в самое ближайшее время и предложат Вам варианты оплаты и доставки дисконтных карт. </p>
        <ul class="pol_card">
            <li>
                <img src="<?=Url::base()?>/site/img/pol_car1.png" alt="" title=""/>
                <p>Вы оставляете заявку</p>
            </li>
            <li>
                <img src="<?=Url::base()?>/site/img/pol_car2.png" alt="" title=""/>
                <p>В течение 5 минут с </br>Вами связывается консультант</p>
            </li>
            <li>
                <img src="<?=Url::base()?>/site/img/pol_car3.png" alt="" title=""/>
                <p>Карту доставляет курьер</p>
            </li>
            <li>
                <img src="<?=Url::base()?>/site/img/pol_car4.png" alt="" title=""/>
                <p>Вы пользуетесь картой «Асар» и экономите на каждой покупке</p>
            </li>
        </ul>
    </div>
    <div class="form_slid">
        <div class="form">

            <?php if($model->type == \app\modules\discount\models\Request::TYPE_PARTNER):?>
                <h2>Регистрация партнера</h2>
            <?php endif?>

            <?php if($model->type == \app\modules\discount\models\Request::TYPE_CLIENT):?>
                <h2>Регистрация клиента</h2>
            <?php endif?>
            <br/>
            <?php $form = ActiveForm::begin()?>
            <?=$form->field($model,'username')->textInput(['placeholder'=>'Имя'])?>
            <?=$form->field($model,'cityId')->dropDownList(\app\modules\cms\models\City::dropDown(),['placeholder'=>'Город'])?>
            <?=$form->field($model,'phone')->textInput(['placeholder'=>'Номер телефона'])?>
            <?=$form->field($model,'email')->textInput(['placeholder'=>'Эмаил'])?>
            <button type="submit"></button>
            <?php ActiveForm::end()?>
        </div>
        <div class="slider">
            <div class="slider_container">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <img src="<?=Url::base()?>/site/images/slider/slide_card.jpg" alt="" title=""/>
                        </li>
                        <li>
                            <img src="<?=Url::base()?>/site/images/slider/slide_card.jpg" alt="" title=""/>
                        </li>
                        <li>
                            <img src="<?=Url::base()?>/site/images/slider/slide_card.jpg" alt="" title=""/>
                        </li>
                        <li>
                            <img src="<?=Url::base()?>/site/images/slider/slide_card.jpg" alt="" title=""/>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>