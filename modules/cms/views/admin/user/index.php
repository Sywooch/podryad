<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Пользователи');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'profile.fio',
            'profile.company',
            [
                'attribute' => 'type',
                'value' => function($model){
                    return $model->typeTitle();
                },
                'filter' => \app\modules\cms\models\User::typeDropdown()
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'buttons'=>[
                    'crib'=>function($url,$model,$key){
                        return Html::a('Списать',$url);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
