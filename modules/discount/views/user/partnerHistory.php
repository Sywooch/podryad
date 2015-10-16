<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

/* @var $this \yii\web\View */
/* @var $historyModel \app\modules\discount\models\history */
/* @var $items \app\modules\discount\models\History[] */
$this->title = 'История посещений:';
?>

<div class="row-fluid">
    <div class="col-md-7">
        <div class="well well-sm">
            <?php
            $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'form-inline'
                        ]
                    ])
            ?>
            <?=
            $form->field($historyModel, 'dateUse')->widget(DatePicker::className(), [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
                'options' => [
                    'class' => 'form-control'
                ]
            ])
            ?>
            <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?> | <?= Html::a('Сбросить фильтр', ['/discount/user/client-history']) ?>
            <?php ActiveForm::end() ?>

        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="col-md-12">
        <?php if ($items): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Клиент</th>
                        <th>Наименование сервиса</th>
                        <th>%</th>
                        <th>Дата</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $i => $item): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $item->user->username ?></td>
                            <td><?= $item->service->title ?></td>
                            <td><?= $item->service->discount ?></td>
                            <td><?= Yii::$app->formatter->asDatetime(strtotime($item->dateUse)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="well well-sm">
                История пуста!
            </div>
        <?php endif; ?>
    </div>
</div>
