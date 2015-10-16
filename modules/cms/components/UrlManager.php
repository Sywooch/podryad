<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 21.05.15
 * Time: 15:33
 */

namespace app\modules\cms\components;


class UrlManager extends \yii\web\UrlManager{

    public function createUrl($params)
    {
        return $this->fixPathSlashes(parent::createUrl($params));
    }

    protected  function fixPathSlashes($url)
    {
        return preg_replace('|\%2F|i', '/', $url);
    }

}