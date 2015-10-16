<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\discount\models\CardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Дисконтные карты');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-index">

    <div class="row">
        <div class="col-md-5">
            <h4>Связать карты</h4>
            <div class="form-card row-fluid well well-sm">
                <?php $form = \yii\bootstrap\ActiveForm::begin(['action' => ['relation'], 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-inline']]) ?>
                <?= $form->field($model, 'relationFile')->fileInput(['class' => 'input-sm form-control']) ?>
                <?= Html::submitButton('Загрузить', ['class' => 'btn btn-primary']) ?>
                <?php \yii\bootstrap\ActiveForm::end() ?>
            </div>
        </div>

        <div class="col-md-7">
            <h4>Генерация карт</h4>
            <div class="form-card row-fluid well well-sm">
                <?= Html::beginForm(['create'], 'post', ['class' => 'form-inline']) ?>
                <label for="quantity">Кол-во карт:</label>
                <input type="text" name="quantity" class="form-control" maxlength="4" size="4"/>
                <label for="type">Тип карт:</label>
                <?= Html::dropDownList('type', '', \app\modules\discount\models\Card::getTypeList(), ['class' => 'form-control']) ?>
                <input type="submit" value="Сгенерировать" class="btn btn-success"/>
                <?= Html::a('Распечатать и скачать', ['/discount/admin/card/print'], ['class' => 'btn btn-primary']) ?>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'number',
            'cvcode',
            'dateCreate:date',
            [
                'attribute' => 'status',
                'value' => 'statusText',
                'filter' => \app\modules\discount\models\Card::getStatusList(),
            ],
            ['attribute' => 'type', 'value' => 'typeValue', 'filter' => \app\modules\discount\models\Card::getTypeList()],
            // 'userId',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]);
    ?>

</div>
