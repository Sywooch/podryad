<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 16.10.15
 * Time: 15:03
 * @var $modelList \app\modules\exchange\models\Tender[]
 * @var $contractorId integer
 */
use yii\helpers\Url;
?>
<div class="modal__title">Выбор тендера</div>
<div class="tender-list">
    <?php if( $modelList ):?>
         <ul>
             <?php foreach($modelList as $model):?>
             <li class="tender-list-item">
                 <a href="<?=Url::to(['/exchange/contractor/notify','contractorId'=>$contractorId,'tenderId'=>$model->id])?>" class="_tender_notify"><?=$model->title?></a>
             </li>
            <?php endforeach?>
         </ul>
    <?php else:?>
        <p>У вас нет тендеров,
            <a href="<?=Url::to(['/exchange/tender/create'])?>">создать?</a></p>
    <?php endif?>
</div>