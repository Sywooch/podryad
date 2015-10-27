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

class CmsBehavior extends Behavior{


    public function imageSrc($size='100x100',$method = Thumbler::METHOD_NOT_BOXED)
    {
        if(!method_exists($this->owner,'getImage'))
            return $this->imageThumb.$size;

        $thumb = \Yii::$app->view->theme->getUrl('static/images/content/default.jpg');

        $image = $this->owner->image;
        $webroot = \Yii::getAlias('@webroot');
        if($image && !is_readable($webroot.'/'.\Yii::$app->thumbler->sourcePath.$image->src))
        {
            return $thumb;
        }
        return $image ? $image->resize($size,$method) : $thumb;
    }

}