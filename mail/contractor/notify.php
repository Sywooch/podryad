<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 16.10.15
 * Time: 15:27
 * @var $tender \app\modules\exchange\models\Tender
 * @var $subject string
 */

use yii\helpers\Url;
?>
<h1><?=$subject?></h1>
<p>
    Вас пригласили для участия в тендере
     "<a href="<?=Url::to(['/exchange/tender/view','id'=>$tender->id],true)?>"><?=$tender->title?></a>"
</p>