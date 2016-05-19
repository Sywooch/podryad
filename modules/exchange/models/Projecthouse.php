<?php

namespace app\modules\exchange\models;

use app\modules\cms\components\TranslitBehavior;
use app\modules\cms\models\Image;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%projecthouse}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $yandexDisk
 * @property string $googleDisk
 * @property string $skyDrive
 * @property UploadedFile $file
 * @property Image $image
 */
class Projecthouse extends \yii\db\ActiveRecord
{
    /**
     * @var @file UploadedFile
     */
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projecthouse}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['title', 'alias', 'yandexDisk', 'googleDisk', 'skyDrive'], 'string', 'max' => 255],
            ['file','file','skipOnEmpty'=>true],
            ['title','unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'alias' => 'Алиас',
            'description' => 'Описание',
            'yandexDisk' => 'Ссылка на Яндекс-диск',
            'googleDisk' => 'Ссылка на Google-диск',
            'skyDrive' => 'Ссылка на skyDrive',
            'file' => 'Фото',
        ];
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(),['primaryKey'=>'id'])->andWhere(['model'=>self::className()]);
    }

    public function behaviors()
    {
        return [
          'translit'=>[
              'class'=>TranslitBehavior::className()
          ]
        ];
    }
}
