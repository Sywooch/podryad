<?php
/** @var $this \yii\web\View */
/** @var $category \app\modules\store\models\Category */
$this->title = 'Товары - категории';
?>
<div class="category-page">

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Корзина товаров:
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                        <?php foreach(Yii::$app->getModule('store')->basket->items as $item):?>
                        <tr>
                            <td>
                                <img src="<?= $item->image->resize('50x50') ?>" alt=""/>
                            </td>
                            <td>
                                <?=$item->title?>
                            </td>
                            <td>
                                <?=$item->basketQuantity?>
                            </td>
                            <td>
                                <a class="btn btn-success btn-xs" href="<?=\yii\helpers\Url::to(['/store/basket/remove','productId'=>$item->id])?>">
                                    <i class="fa fa-remove"></i> удалить
                                </a>
                            </td>
                        </tr>
                        <?php endforeach?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    В корзине <?=Yii::$app->getModule('store')->basket->totalQuantity?>
                </div>
            </div>
        </div>
    </div>

    <h1><?=$category->title?></h1>
    <div class="row">
        <?php foreach($category->products as $product):?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=$product->title?>
                </div>
                <div class="panel-body">
                    <img src="<?= $product->image->resize() ?>" alt=""/>
                    <br/>
                    <small>Минимальный заказ: <?=$product->minCount?></small>
                    <?=\yii\helpers\Html::beginForm(['/store/basket/add'])?>
                    <?=\yii\helpers\Html::hiddenInput('productId',$product->id)?>
                    <?=\yii\helpers\Html::hiddenInput('quantity',1)?>
                    <?=\yii\helpers\Html::submitButton('Добавить в корзину',['class'=>'btn btn-success btn-block'])?>
                    <?=\yii\helpers\Html::endForm()?>
                </div>
            </div>
        </div>
        <?php endforeach?>
    </div>
</div>