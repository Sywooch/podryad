<?php

namespace app\modules\exchange\models;

use alexBond\thumbler\Thumbler;
use app\modules\cms\components\CmsBehavior;
use app\modules\cms\components\TranslitBehavior;
use Yii;

/**
 * This is the model class for table "{{%contractor_album}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property integer $userId
 * @property Image[] $images
 * @property Image $image
 * @property Contactor $user
 * @property integer $imagesCount
 */
class Album extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contractor_album}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 128],
            ['title','required'],
            ['title','unique','targetAttribute'=>['userId','title']],
            ['alias','unique','targetAttribute'=>['userId','alias']],
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
            'alias' => Yii::t('app', 'Ярлык'),
            'userId' => Yii::t('app', 'User ID'),
        ];
    }

    public function behaviors()
    {
        return [
          'translit'=>[
              'class'=>TranslitBehavior::className(),
          ],
            'cms'=>[
                'class'=>CmsBehavior::className(),
            ]
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Contactor::className(),['id'=>'userId']);
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(),['primaryKey'=>'id'])
            ->andWhere(['model'=>self::className()]);
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(), ['primaryKey' => 'id'])
            ->andWhere(['model' => self::className()])->orderBy(['id'=>SORT_DESC]);
    }

    public function getImagesCount()
    {
        return $this->hasMany(Image::className(), ['primaryKey' => 'id'])
            ->andWhere(['model' => self::className()])->count();
    }

    /**
     * @return Album[]
     */
    public static function  getAllByUser($userId)
    {
        return self::find()
            ->where(['userId'=>$userId])
            ->orderBy(['title'=>SORT_ASC])
            ->all();
    }

    public function beforeDelete()
    {
        foreach($this->images as $image)
        {
            $image->delete();
        }
        return parent::beforeDelete();
    }

    /**
     * @param $userId
     * @param $limit
     * @return Image[]
     */
    public static function getAllImagesByUser($userId,$limit)
    {
        $albumList = self::find()
            ->innerJoinWith(['images'])
            ->where(['userId'=>$userId])
            ->all();
        $images = [];
        foreach($albumList as $album)
        {
            foreach($album->images as $image)
            {
                $images[] = $image;
                if($limit == sizeof($images))
                {
                    break;
                }
            }
            if ($limit == sizeof($images)) {
                break;
            }
        }
        shuffle($images);
        return array_splice($images,0,$limit);
    }
}
