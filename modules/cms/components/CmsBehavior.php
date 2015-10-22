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

    private $imageThumb = 'http://placehold.it/';

    public function imageSrc($size='100x100',$method = Thumbler::METHOD_NOT_BOXED)
    {
        if(!method_exists($this->owner,'getImage'))
            return $this->imageThumb.$size;

        $image = $this->owner->image;
        if($image && !is_file(\Yii::$app->thumbler->sourcePath.$image->src))
        {
            return $this->imageThumb . $size;
        }
        return $image ? $image->resize($size,$method) : $this->imageThumb.$size;
    }

}