<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 16.10.15
 * Time: 15:21
 * @var $tender \app\modules\exchange\models\Tender
 * @var $contractor \app\modules\exchange\models\Contactor
 */
?>
<div class="modal__title">Приглашение успешно отправленно!</div>
<p>
    Подрядчику "<?=$contractor->profile->company ? $contractor->profile->company : $contractor->profile->fio?>" было выслано приглашение в участии вашего тендера <?=$tender->title?>.
</p>