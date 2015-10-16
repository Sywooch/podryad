<?php

namespace app\modules\store\assets;
use yii\web\AssetBundle;


class BasketAsset extends AssetBundle{

    public $basePath = '@webroot/site';
    public $baseUrl = '@web/site';

    public $js = [
        'js/app.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}