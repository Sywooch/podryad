<?php

namespace app\modules\cms\models;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $metaKeywords
 * @property string $metaDescription
 * @property string $dateCreate
 * @property integer $visible
 * @property integer $parentId
 * @property Page $page

 */

class Model extends ActiveRecord{

    static $model=[];
    public $parentId;

    /**
     * @return Page
     */
    protected static function getModel($systemName = 'default')
    {
        if(self::$model[$systemName])
            return self::$model[$systemName];

        if($systemName ==  'default')
            self::$model[$systemName] = new Page(['type'=>Page::ITEM]);
        else
            self::$model[$systemName] = Page::findOne(['systemName'=>$systemName]);

        return self::getModel($systemName);
    }

    /**
     * @return \app\modules\cms\models\Page
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(),['id'=>'pageId']);
    }

    public function getTitle(){
        return $this->page->title;
    }

    public function getDescription(){
        return $this->page->description;
    }

    public function getUrl(){
        return $this->page->title;
    }

    public function getSeoWords(){
        return $this->page->metaKeywords;
    }

    public function getSeoDescription(){
        return $this->page->metaDescription;
    }

    public function getDateCreate(){
        return $this->page->dateCreate;
    }

    public function getChildren($all = null)
    {
        return $this->page->children($all);
    }

    public function getParents($all = null)
    {
        return $this->page->parents($all);
    }

    protected $pageAttributes = [
        'title',
        'alias',
        'description',
        'metaDescription',
        'metaKeywords',
        'dateCreate',
        'visible',
    ];

    public function setAttributes($attributes)
    {
        $model = $this->getModel();

        foreach($attributes as $attribute => $value)
        {
            if(in_array($attribute,$this->pageAttributes))
            {
                $model->title = $value;
                unset($attributes[$attribute]);
                continue;
            }
        }

        $model->save();
        $attributes['pageId'] = $model->id;

        parent::setAttributes($attributes);
    }

    public static function getDropdown()
    {
        $data = [];
        $model = self::getModel(self::$systemName);
        foreach($model->children() as $item)
        {
            $title = str_pad('-',$item->lvl).' '.$item->title;
            $data[] = ['id'=>$item->id,'title'=>$title];
        }
    }

    public function beforeSave($insert)
    {
        /* @var $parent Page */
        $parent = Page::findOne(['id'=>$this->parentId]);
        $parent->appendTo($this->getModel());

        return parent::beforeSave($insert);
    }

    public function findByUrl($alias)
    {
        /* @var $model Page */

        $url = $alias;
        $urlList = [];
        $urlCheck = [];

        if(substr_count($url,'/'))
        {
            $urlList = explode('/', $url);
            $url = array_pop($urlList);
        }

        $model = Page::findOne(['alias'=>$url]);
        $parents = $model->parents();

        foreach($parents as $item)
        {
            $urlCheck[] = $item->alias;
        }

        if($urlList == $urlCheck)
            return $model;

        return null;
    }
}