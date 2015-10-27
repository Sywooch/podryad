<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 27.10.15
 * Time: 17:52
 * @var $model \app\modules\exchange\models\Offers
 * @var $subject string
 *
 */
?>
<h1><?=$subject?></h1>
<div>
    <ul>
        <li>Имя: <?=$model->tender->user->title?></li>
        <li>Телефон: <?=$model->tender->user->profile->phone?></li>
        <li>
            Тендер:
            <a href="<?=\yii\helpers\Url::to(['/exchange/tender/view','id'=>$model->tender->id])?>"><?=$model->tender->title?></a>
        </li>
        <li>Цена: <?=$model->price?></li>
        <li>Описание: <?=$model->description?></li>
    </ul>
</div>
<p>
    Для подробного проссмотра предложения, вам нужно перейти по
    <a href="<?=\yii\helpers\Url::to(['/exchange/tender/view','id'=>$model->tender->id],true)?>">
    ссылке.
    </a>
</p>