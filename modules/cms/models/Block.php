<?php

namespace app\modules\cms\models;

use app\modules\cms\components\CmsBehavior;
use Yii;

/**
 * This is the model class for table "{{%block}}".
 *
 * @property integer $id
 * @property string $alias
 * @property string $title
 * @property string $content
 * @property Image[] $images
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['alias'], 'string', 'max' => 64],
            [['title'], 'string', 'max' => 128],
            ['alias','unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Ярлык'),
            'title' => Yii::t('app', 'Название'),
            'content' => Yii::t('app', 'Содержание'),
        ];
    }

    public function behaviors()
    {
        return [
          'cms'=>[
              'class'=>CmsBehavior::className(),
          ]
        ];
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(),['primaryKey'=>'id'])
            ->andWhere(['model'=>self::className()]);
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'primaryKey'])
            ->andWhere(['model' => self::className()]);
    }

    /**
     * @param $alias
     * @return Block
     */
    static $images = [];
    public static function get($alias)
    {
        $item = self::find()->where(['alias'=>$alias])->one();
        if(!$item)
        {
            return 'Блок с ярлыком <strong>'.$alias.'</strong> не найден!';
        }
        if($item->images)
        {
            foreach($item->images as $image)
            {
                self::$images[$alias] = $image;
            }
        }
        return $item->content;
    }

    public static function images($alias)
    {
        return !empty(self::$images[$alias]) ? self::$images[$alias] : [];
    }
}
