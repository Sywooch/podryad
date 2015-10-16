<?php


/* @var $this \yii\web\View */
/* @var $model app\modules\reviews\models\ProfileForm */
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use \yii\helpers\Html;

$this->title = 'Добавление пользователя';
?>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Добавление пользователя</div>
            <div class="panel-body">
                    <?php
                    Modal::begin([
                        'id'=>'social-info',
                        'header' => '<h4>Выбор социальной сети:</h4>',
                        'toggleButton' => ['label' => 'Получить данные из соц.сети','class'=>'btn btn-block btn-primary'],
                    ]);

                    echo Tabs::widget([
                        'items' => [
                            [
                                'label' => 'VK.com',
                                'content' => $this->render('social/vkForm'),
                                'active' => true
                            ],
                        ],
                    ]);

                    Modal::end();
                    ?>
                <br/>
                <?php $form = ActiveForm::begin([
                    'options'=>['enctype'=>'multipart/form-data',]
                ])?>

                <div class="row">
                    <div class="col-md-4">
                        <?=$form->field($model,'countryId')->dropDownList(\app\modules\geo\models\Country::dropDown(),['prompt'=>' --- '])?>

                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model,'regionId')->dropDownList($regionList,['prompt'=>' --- '])?>

                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model,'cityId')->dropDownList($cityList,['prompt'=>' --- '])?>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4"><?=$form->field($model,'familiya')?></div>
                    <div class="col-md-4"><?=$form->field($model,'imya')?></div>
                    <div class="col-md-4"><?=$form->field($model,'otchestvo')?></div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?=$form->field($model,'pol')->radioList(\app\modules\reviews\models\Profile::polList())?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php
                            echo '<label class="control-label">Дата рождения</label>';
                            echo DatePicker::widget([
                                'model' => $model,
                                'attribute'=>'dataRojdeniya',
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'format' => 'yyyy-mm-dd',
                                    'startView'=>'decade',
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?=$form->field($model,'foto')->fileInput()?>
                    </div>
                    <div class="col-md-6">
                        <?=Html::activeHiddenInput($model,'photoUrl')?>
                        <img id="photo-preview" src="" alt="photo-preview" style="width: 100px;display: none"/>
                    </div>
                </div>

                <?=\yii\helpers\Html::error($model,'foto')?>
                <?=$form->field($model,'informaciya')->textarea()?>
                <?=\yii\helpers\Html::submitButton('Добавить',['class'=>'btn btn-success btn-block'])?>
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>

