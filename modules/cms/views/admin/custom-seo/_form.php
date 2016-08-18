<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\CustomSeo */
/* @var $form yii\widgets\ActiveForm */

$cityParent = \app\modules\cms\models\Reference::findOne(['alias'=>'cityList']);
$specializationParent = \app\modules\cms\models\Reference::findOne(['alias'=>'specializacii']);

$cityList = $cityParent->dropdown(false);
$specializationList = $specializationParent->dropdown(false);

?>

<div class="custom-seo-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-control"></div>
            <h2 class="panel-title"><?=Html::encode($this->title)?></h2>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'cityId')->dropDownList($cityList, ['prompt' => '-']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'specializationId')->dropDownList($specializationList,
                                ['prompt' => '-']) ?>
                        </div>
                    </div>


                    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'metaKeywords')->textArea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'metaDescription')->textArea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'seoText')->textArea(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
