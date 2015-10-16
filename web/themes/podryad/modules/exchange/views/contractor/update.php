<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 06.10.15
 * Time: 15:51
 * @var $this \yii\web\View
 * @var $model \app\modules\exchange\models\Contactor
 * @var $selected string
 */
use yii\bootstrap\Tabs;
$this->title = 'Обновление профиля';
echo Tabs::widget([
    'items' => [
         [
            'label' => 'Цены',
            'content' => \app\modules\exchange\widgets\PriceList::widget(),
            'active' => $selected == 'price'
        ],
        [
            'label' => 'Описание',
            'content' => $this->render('_description',['model'=>$model]),
            'active' => $selected == 'description'
        ],
    ],
]);
?>

