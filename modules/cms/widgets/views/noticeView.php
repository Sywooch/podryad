<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 04.08.15
 * Time: 10:09
 */
?>
<?php if(Yii::$app->session->hasFlash('success')):?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?=Yii::$app->session->getFlash('success')?>
    </div>
<?php endif;?>