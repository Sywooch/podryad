<?php
use yii\helpers\Url;
use app\modules\discount\models\Card;
?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <?php if( ($cardLink = Card::getLinkByUser()) ):?>
            <li>
                <a href="<?=$cardLink?>">Профиль</a>
            </li>
            <?php endif;?>
            
            <?php if(Yii::$app->user->can('client')):?>
            <li>
                <a href="<?=Url::to(['/discount/user/client-history'])?>">История</a>
            </li>
            <?php endif;?>
            
            <?php if(Yii::$app->user->can('partner')):?>
            <li>
                <a href="<?=Url::to(['/discount/user/partner-history'])?>">История</a>
            </li>
            <?php endif;?>
            
            <?php if(Yii::$app->user->can('client')):?>
            <li>
                <a href="<?=Url::to(['/discount/user/partner'])?>">Партнерская программа</a>
            </li>
            <?php endif;?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->