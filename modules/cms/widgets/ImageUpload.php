<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 19.05.15
 * Time: 18:11
 */

namespace app\modules\cms\widgets;


use app\modules\cms\models\Image;
use yii\bootstrap\Widget;

class ImageUpload extends Widget
{

    public $primaryKey;
    public $model;
    public $maxNumberOfFiles = 3;

    public function run()
    {
        $inModel = $this->model;
        $model = new Image();
        $model->model = $inModel::className();
        $model->primaryKey = $this->primaryKey;

        return $this->render('ImageUploadView', [
            'fileUploadData' => $model->getWidgetUploadData(),
            'primaryKey' => $this->primaryKey,
            'inModel' => $this->model,
            'model' => $model,
            'maxNumberOfFiles'=>$this->maxNumberOfFiles,
        ]);
    }

}