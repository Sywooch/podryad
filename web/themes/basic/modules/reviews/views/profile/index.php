<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 09.07.15
 * Time: 17:48
 * @var $this \yii\web\View
 * @var $models \app\modules\reviews\models\Profile[]
 * @var $model \app\modules\reviews\models\Profile
 */
use app\modules\reviews\models\Profile;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = 'Заголовок главной страницы';
?>

<div class="well">
    <?php $form = ActiveForm::begin(['method'=>'GET'])?>
    <div class="row">
        <div class="col-md-4">
            <?=$form->field($model,'countryId')->dropDownList(\app\modules\geo\models\Country::dropDown(),['prompt'=>' --- '])?>
            <?=$form->field($model,'regionId')->dropDownList($regionList,['prompt'=>' --- '])?>
            <?=$form->field($model,'cityId')->dropDownList($cityList,['prompt'=>' --- '])?>
        </div>
        <div class="col-md-4">
            <?=$form->field($model,'imya')?>
            <?=$form->field($model,'familiya')?>
            <?=$form->field($model,'pol')->radioList(Profile::polList())?>
        </div>
        <div class="col-md-4">
            <?=Html::submitButton('Поиск',['btn btn-success'])?>
        </div>
    </div>
    <?php ActiveForm::end()?>
</div>

<div class="row">

    <?php foreach($models as $model):?>
    <div class="col-md-4">
        <?=$this->render('@app/modules/reviews/views/profile/_user.php',['model'=>$model])?>
    </div>
    <?php endforeach?>

</div>