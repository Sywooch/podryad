<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 16.10.15
 * Time: 12:46
 * @var $this \yii\web\View
 * @var $model \app\modules\cms\models\form\RemindUser
 */

use yii\widgets\ActiveForm;

$this->title = 'Восстановление доступа к аккаунту';
?>
<main class="main">
    <section class="news-content">
        <div class="beseda">
            <div class="item_title">
                <h1><?= $this->title ?></h1>
            </div>
            <div class="form_vxod">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'options' => [
                            'class' => 'form_input'
                        ]
                    ],
                ]); ?>
                <?= $form->field($model, 'username')?>
                <div class="form_button_vxod">
                    <button> Восстановить доступ</button>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </section>
    <?= $this->render('//layouts/_sidebar') ?>
</main>