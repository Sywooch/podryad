<?php

namespace app\modules\cms\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $file
 * @property string $fileLink
 * @property string $filePath
 */
class File extends \yii\db\ActiveRecord
{
    const FILE_DIR = '@webroot/uploads/file';
    const WEB_DIR = '@web/uploads/file';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['title'], 'string', 'max' => 128],
            ['file','file','skipOnEmpty'=>true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'file' => Yii::t('app', 'Файл'),
        ];
    }

    public function getFileLink()
    {
        return Url::to(['/cms/file/download','id'=>$this->id]);
    }

    public function download()
    {
        $name = \app\modules\cms\components\Translit::str2url($this->title);
        $extension = substr(
          $this->file,
          strripos(
              $this->file,
              '.'
          )
        );
        $name .=$extension;
        \Yii::$app->response->sendFile(
            $this->filePath,
            $name
        );
    }

    public function getFilePath()
    {
        return \Yii::getAlias(self::FILE_DIR . '/' . $this->oldAttributes['file']);
    }
}
