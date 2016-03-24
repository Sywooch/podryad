<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 27.08.15
 * Time: 11:42
 * @method string imageSrc(string $size = '100x100', string $method = Thumbler::METHOD_NOT_BOXED)
 */

namespace app\modules\cms\components;


use alexBond\thumbler\Thumbler;
use app\modules\cms\models\Image;
use yii\base\Behavior;
use yii\helpers\Url;

class CmsBehavior extends Behavior{


    public function imageSrc($size='100x100',$method = Thumbler::METHOD_NOT_BOXED)
    {
        if(!method_exists($this->owner,'getImage'))
            $src = 'default.jpg';
        else{
            $image = $this->owner->image;

            $webroot = \Yii::getAlias('@webroot');

            if ($image && !is_readable($webroot . '/' . \Yii::$app->thumbler->sourcePath . $image->src)) {
                $src = 'default.jpg';
            } else {
                $src = $image ? $image->src : 'default.jpg';
            }
        }
        return $this->resize($src, $size, $method);
    }

    public function resize($src,$size = '100x100', $method = Thumbler::METHOD_NOT_BOXED)
    {
        list($width, $height) = explode('x', $size);
        if ($this && !is_file(\Yii::$app->thumbler->sourcePath . '/' . $src)) {
            $src = 'default.jpg';
        }
        if ($src) {
            if(!is_file($src))
            {
                return 'http://placehold.it/'.$size;
            }
            $file = \Yii::$app->thumbler->resize($src, $width, $height, $method);
            return Url::base() . \Yii::getAlias('@web/' . \Yii::$app->thumbler->thumbsPath) . $file;
        }
    }

}