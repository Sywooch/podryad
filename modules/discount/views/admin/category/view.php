<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <div>
        <?= \yii\widgets\Breadcrumbs::widget(['links' => $model->breadcrumbs()]) ?>
        <p>Получение родительских элементов от <?= $model->title ?></p>

        <p>Абсалютный путь: <?= $model->getPath() ?></p>

        <p>Полное название: <?= $model->FullTitle ?></p>
        <?php if (($children = $model->childrens())): ?>
            <dl>
                <?php foreach ($children as $child): ?>
                    <dt><?= $child->title ?></dt>
                    <dd><?= $child->getPath() ?></dd>
                <?php endforeach ?>
            </dl>
        <?php endif ?>
        <dl>
            <dt>Список дочерних элекментов</dt>
            <dd>
                <ul>
                    <?php
                    $package = $model->getItems(['pageSize'=>2]);
                    foreach ($package->models as $item): ?>
                        <li>
                            <div class="breadcrumbs">
                                <?= \yii\widgets\Breadcrumbs::widget(['links' => $item->breadcrumbs()]) ?>
                            </div>
                            <p>Title: <?=$item->title?></p>
                            <p>Url: <?= $item->path ?></p>
                            <p>Category: <?=$item->category->title?></p>
                            <p>FullTitle: <?=$item->category->FullTitle?></p>
                        </li>
                    <?php endforeach ?>
                </ul>
                <div class="pagination">
                    <?php
                    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $package->pages,
                    ]);
                    ?>
                </div>
            </dd>
        </dl>
    </div>


</div>
