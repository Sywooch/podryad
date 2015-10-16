<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 19.05.15
 * Time: 18:29
 */

namespace app\modules\cms\controllers\admin;


use app\modules\cms\models\Image;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use Yii;

class ImageController extends Controller
{

    public function actionUpload($model, $primaryKey)
    {
        $results = [];
        $modelImage = new Image();
        $modelImage->model = $model;
        $modelImage->primaryKey = $primaryKey;
        if (Yii::$app->request->isPost) {
            $modelImage->file = UploadedFile::getInstance($modelImage, 'file');
            if ($modelImage->file && $modelImage->validate()) {
                /*
                {
                    "name": "picture1.jpg",
                    "size": 902604,
                    "url": "http:\/\/example.org\/files\/picture1.jpg",
                    "thumbnailUrl": "http:\/\/example.org\/files\/thumbnail\/picture1.jpg",
                    "deleteUrl": "http:\/\/example.org\/files\/picture1.jpg",
                    "deleteType": "DELETE"
                  },
                */
                $filename = md5($model.$primaryKey.$modelImage->file->name).'.'.$modelImage->file->extension;
                $modelImage->src = $filename;
                $modelImage->save();
                if($modelImage->file->saveAs(Yii::getAlias(Image::FILE_DIROOT).$filename))
                {
                    $imagePath = Yii::getAlias(Image::FILE_DIR).$filename;
                    $result = [
                        'name' => $filename,
                        'size' => $modelImage->file->size,
                        'url' => $imagePath,
                        'thumbnailUrl' => $modelImage->resize(),
                        'deleteUrl'=>Url::to(['/cms/admin/image/delete','id'=>$modelImage->id]),
                        'deleteType'=>"DELETE",
                    ];
                    $results[]=$result;
                }
            } else
                $results[] = (object)[
                    $modelImage->file->name => false,
                    'error'=>strip_tags(Html::error($modelImage,'file' )),
                    'extension'=>$modelImage->file->extension,
                    'type'=>$modelImage->file->type,
                ];
        }
        echo json_encode(
            (object)[
                'files' => $results
            ]
        );
    }

    public function actionDelete($id)
    {
        $model = Image::findOne($id);
        if($model)
        {
            $model->delete();
            $result = (object)[
                'success'=>true,
                'path'=>Yii::getAlias(Image::FILE_DIR).$model->src,
                'file'=>is_file(Yii::getAlias(Image::FILE_DIROOT).$model->src),
            ];
            echo Json::encode($result);
        }
    }

}