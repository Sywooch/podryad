<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Pyramid */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pyramids'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pyramid-view">


    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'parentId',
        ],
    ]) ?>

    <div class="b-pyramid">
        <?php
        $pyramid = $model->pyramid();
        foreach($pyramid as $lvl=>$lvlData)
        {
            echo '<div class="row-fluid">';
            echo '<h4>Уровень:'.$lvl.'</h4>';

            foreach($lvlData as $position=>$posData)
            {
                echo '<div class="box">'.$posData->title.'</div>';
            }
            echo '</div>';
        }
        ?>
    </div>


</div>

<style>
    .b-pyramid{

    }

    .b-pyramid .row-fluid{
        overflow: hidden;
        text-align: center;
    }

    .b-pyramid .box{
        width: 100px;
        height: 100px;
        display: inline-block;
        padding:20px;
        border-radius: 50px;
        border:1px solid #ccc;
        margin-right: 20px;
        line-height: 60px;
        font-weight: bold;
    }
</style>