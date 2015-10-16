<?php
/* @var $this ivphpan\yandexMap\Map */
/* @var $view \yii\web\View */
?>
<div class="b-ivphpan-container row-fluid">

    <div class="col-md-6">

        <label for="ivphpanYandexMapAddress">Поиск по адресу:</label>
        <input type="text" id="ivphpanYandexMapAddress" class="form-control"/>
        <br/><br/>
        <label for="ivphpanYandexMapCords">Координаты</label>
        <?=\yii\helpers\Html::activeTextInput($model,$attribute,$options)?>
    </div>

    <div class="col-md-6">

        <div id="ivphpanYandexMapArea">

        </div>

    </div>

</div>

<style>
    .b-ivphpan-container{
        background: #3c3c3c;
        color:#f5f5f5;
        border-radius: 10px;
        overflow: hidden;
        padding:20px;
        margin-bottom: 20px;
    }

    #ivphpanYandexMapArea{
        height: 200px;
        border:1px solid #0d0d0d;
    }
</style>
