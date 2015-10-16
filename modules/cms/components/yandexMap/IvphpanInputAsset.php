<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 29.05.15
 * Time: 12:13
 */

namespace app\modules\cms\components\yandexMap;


use yii\web\AssetBundle;

class IvphpanInputAsset extends AssetBundle{

    public $js = [
        'inputMap.js',
        'yii2-yandex-map.js',
        'http://api-maps.yandex.ru/2.1/?lang=ru_RU',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }

}