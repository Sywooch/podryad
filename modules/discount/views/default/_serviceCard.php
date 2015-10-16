<?php
/* @var $model app\modules\discount\models\Service */?>
<li>
    <a href="<?=\yii\helpers\Url::to(['/discount/default/service','path'=>$model->getPath()])?>">
        <div class="first_lvl">
            <img src="<?=$model->image()->resize('360x222')?>" alt="" title=""/>

            <div class="poloska">
                <p><?=$model->title?></p>

                <div class="discount">
                    <p><?=$model->discount?>%</p>
                </div>
            </div>
        </div>
    </a>
</li>