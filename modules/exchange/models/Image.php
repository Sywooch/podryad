<?php

namespace app\modules\exchange\models;

/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 12.10.15
 * Time: 10:40
 *
 *
 * @property \app\modules\exchange\models\Album $album
 */


class Image extends \app\modules\cms\models\Image{

    public function getAlbum()
    {
        return $this->hasOne(Album::className(),['id'=>'primaryKey'])->andWhere(['model'=>Image::className()]);
    }
}