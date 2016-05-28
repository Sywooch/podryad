<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\User */

use yii\bootstrap\Tabs;

$this->title = Yii::t('app', 'Редактирование пользователя: ') . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-update">

    <?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Данные',
                'content' => $this->render('_form', [
                    'model' => $model,
                    'profile' => $profile,
                ]),
                'active' => true
            ],
            [
                'label' => 'Альбомы',
                'content' => $this->render('_album',['model'=>$model,'profile'=>$profile]),
                'visible'=>$model->role == \app\modules\cms\models\User::ROLE_CONTRACTOR
            ],
        ],
    ]);
    ?>


</div>
