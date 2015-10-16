<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 09.07.15
 * Time: 17:19
 */

namespace app\modules\cms\components;


use \alexBond\thumbler\Thumbler;
use \yii\base\Behavior;

class ImageBehavior extends Behavior{

    public $attribute = 'image';
    public $dir = '';

    public function thumb($size)
    {
        list($width,$height) = explode('x',$size);
        $file = $this->dir.$this->owner->{$this->attribute};
        $fullPath = \Yii::getAlias('@webroot/uploads').'/'.$file;

        if(!is_file($fullPath))
        {
            return 'http://placehold.it/'.$size;
        }

        $webPath = \Yii::getAlias('@web/').\Yii::$app->thumbler->thumbsPath;
        $thumb = \Yii::$app->thumbler->resize($file,$width,$height,Thumbler::METHOD_CROP_CENTER);
        return $webPath.$thumb;
    }

    public function events()
    {
        return [

        ];
    }
}