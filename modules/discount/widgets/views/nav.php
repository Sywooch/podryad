<?php
/* @var $items \app\modules\discount\models\Category[] */?>
<div class="menu">
    <ul class="menu_display">
        <?php foreach($items as $item):?>
        <li>
            <a href="<?=\yii\helpers\Url::to(['/discount/default/category','path'=>$item->getPath()])?>">
                <?=$item->title?>
                <?php if(($childrens = $item->children())):?>
                <i class="fa fa-caret-down"></i>
            </a>
			<div class="sb">
				<ul class="sub_menu">
					<?php foreach($childrens as $subItem):?>
					<li><a href="<?=\yii\helpers\Url::to(['/discount/default/category','path'=>$subItem->getPath()])?>"><?=$subItem->title?></a></li>
					<?php endforeach?>
				</ul>
			</div>
            <?php else:?>
                </a>
            <?php endif?>
        </li>
        <?php endforeach?>
    </ul>
</div>