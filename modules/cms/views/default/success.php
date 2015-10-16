<?php
/* @var $this \yii\web\View */
?>

<div class="b-success-block">
    <p><?=$message?></p>
    <p>Вы будете переадресованы на главую страницу <br/>
        через <var class="js-success-block__second"></var></p>
</div>

<style>
    .b-success-block{

    }

    .b-success-block p{

    }

    .js-success-block__second{

    }
</style>

<script>
    var timer = null;
    var i = 3;
    timer = setInterval(function(){
        $(".js-success-block__second").text(i);
        if(i==1)
        {
            location.href="<?=\yii\helpers\Url::base()?>/";
        }
        i--;
    },1000)
</script>