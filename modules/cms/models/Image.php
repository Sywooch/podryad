<?php

namespace app\modules\cms\models;

use alexBond\thumbler\Thumbler;
use Yii;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property integer $id
 * @property string $src
 * @property string $file
 * @property string $model
 * @property integer $primaryKey
 */
class Image extends \yii\db\ActiveRecord
{
    const FILE_DIROOT = '@webroot/images/';
    const FILE_DIR = '@web/images/';
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'primaryKey'], 'required'],
            [['file'], 'file', 'mimeTypes'=>['image/jpeg','image/gif','image/png']],
            [['primaryKey'], 'integer'],
            ['src','string','min'=>1],
            [['model', 'src'], 'string', 'max' => 255]
        ];
    }

    public function create()
    {
        $filename = md5($this->model . $this->primaryKey . $this->file->name) . '.' . $this->file->extension;
        $this->src = $filename;
        $this->save();
        $this->file->saveAs(Yii::getAlias(self::FILE_DIROOT) . $filename);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'src' => Yii::t('app', 'Изображение'),
            'model' => Yii::t('app', 'Модель'),
            'primaryKey' => Yii::t('app', 'Ключ'),
        ];
    }

    public function resize($size = '100x100',$method=Thumbler::METHOD_NOT_BOXED)
    {
        list($width, $height) = explode('x', $size);
        if($this->src)
        {
            $file = Yii::$app->thumbler->resize($this->src, $width, $height,$method);
            return Url::base().Yii::getAlias('@web/' . Yii::$app->thumbler->thumbsPath) . $file;
        }
        return 'http://placehold.it/'.$size;
    }

    public function beforeDelete()
    {
        $filename = Yii::getAlias(self::FILE_DIROOT) . $this->src;
        $this->imageDelete($filename);
        return parent::beforeDelete();
    }

    public function beforeSave($insert = true)
    {
        $filename = Yii::getAlias(self::FILE_DIR) . $this->src;
        $this->imageDelete($filename);
        return parent::beforeSave($insert);
    }

    protected function imageDelete($filename)
    {
        if (is_writeable($filename)) {
            unlink($filename);
            Yii::$app->thumbler->clearImageCache($this->src);
        }
    }

    public function getWidgetUploadData()
    {
        $results = [];

        $items = Image::find()->where([
            'model' => $this->model,
            'primaryKey' => $this->primaryKey
        ])->all();

        $web = Yii::getAlias(self::FILE_DIR);
        $webroot = Yii::getAlias(self::FILE_DIROOT);

        foreach ($items as $item) {
            $webImage = $web . $item->src;
            $webrootImage = $webroot . $item->src;
            $thumb = $item->resize();
            $size = filesize($webrootImage);
            $result = [
                'name' => $item->src,
                'size' => $size,
                'url' => $webImage,
                'thumbnailUrl' => $thumb,
                'deleteUrl' => Url::to(['/cms/admin/image/delete', 'id' => $item->id]),
                'deleteType' => "DELETE",
            ];
            $results[] = $result;
        }
        if ($results)
            return Json::encode($results);

        return null;
    }
}
