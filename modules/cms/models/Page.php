<?php

namespace app\modules\cms\models;

use alexBond\thumbler\Thumbler;
use app\modules\cms\components\CategoryBehavior;
use app\modules\cms\components\ItemBehavior;
use app\modules\cms\components\Shortext;
use app\modules\cms\components\TranslitBehavior;
use app\modules\directorBoard\models\Board;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $metaKeywords
 * @property string $metaDescription
 * @property string $dateCreate
 * @property integer $visible
 * @property string $bg
 * @property string $path
 * @property string $group
 * @property integer $parentId
 * @property integer $childId
 * @property PageDoctor[] $doctorList
 * @property Board $personal
 * @property integer $articleShow
 * @property Page $child
 * @property $templateList []
 * @property $template []
 * @property \app\modules\cms\models\Category $category
 */
class Page extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['alias'],'unique'],
            [['description','group'], 'string'],
            [['dateCreate'], 'safe'],
            [['visible', 'parentId','articleShow','childId','personalId'], 'integer'],
            ['parentId','default','value'=>'0'],
            [['title', 'alias', 'metaKeywords', 'metaDescription'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Заголовок'),
            'alias' => Yii::t('app', 'Url'),
            'path' => Yii::t('app', 'Url'),
            'description' => Yii::t('app', 'Содержание'),
            'metaKeywords' => Yii::t('app', 'Ключевые слова'),
            'metaDescription' => Yii::t('app', 'Мета содержание'),
            'dateCreate' => Yii::t('app', 'Дата создания'),
            'visible' => Yii::t('app', 'Видимость'),
            'parentId' => Yii::t('app', 'Категория'),
            'childId' => Yii::t('app', 'Меню подкатегорий'),
            'articleShow' => Yii::t('app', 'Показать список акций'),
            'personalId' => Yii::t('app', 'Выбор сотрудника'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Page::className(),['id'=>'parentId']);
    }

    public function behaviors()
    {
        return [
            'translit'=>[
                'class'=>TranslitBehavior::className(),
            ],
            'category'=>[
                'class'=>CategoryBehavior::className(),
                'route'=>'/cms/default/page',
            ],
            'shortext' => [
                'class' => Shortext::className(),
            ],
        ];
    }

    public function findByPath($path)
    {
        return self::find()->where(
            [
                'alias'=>$path,
            ]
        )->one();
    }

    public function getPath()
    {
        return Url::to(['/cms/default/page','path'=>$this->fullPath]);
    }

    public function imageThemeSet()
    {
        $content = $this->description;
        $theme = Yii::$app->controller->view->theme->baseUrl;
        $content = preg_replace('#\<img([^src=]+)src\=(\"|\')([^(\'|\")]+)(\"|\')#i','<img src="'.$theme.'/$3"',$content);
        $content = preg_replace('#href\=(\"|\')([^(\'|\")]+)(\"|\')#i','href="'.$theme.'/$2"',$content);
        $this->description = $content;
    }

    public function getUrlCode()
    {
        return '<?=Url::to([\'/cms/default/page\',\'path\'=>\''.$this->fullPath.'\'])?>';
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(),['primaryKey'=>'id'])
            ->andWhere(['model'=>self::className()]);
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['primaryKey' => 'id'])
            ->andWhere(['model' => self::className()]);
    }

    public function getbg()
    {
        $image =  $this->image;
        return $image ? $image->resize('1900x360',Thumbler::METHOD_BOXED) : null;
    }

    public function getChild()
    {
        return $this->childId ? self::findOne($this->childId) : null;
    }

    public function getDoctorList()
    {
        return $this->hasMany(PageDoctor::className(),['pageId'=>'id']);
    }
}
