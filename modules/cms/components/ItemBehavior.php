<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 18.05.15
 * Time: 16:17
 */

namespace app\modules\cms\components;


use yii\base\Behavior;
use yii\helpers\Url;

class ItemBehavior extends Behavior{

    public $prefix;

    public function getSiblings($limit=4)
    {
        $class = $this->owner;
        return $class->find()->where('parentId=:parentId and id<>:id',[
            ':parentId'=>$this->owner->parentId,
            ':id'=>$this->owner->id,
        ])->limit($limit)->all();
    }

    public function breadcrumbs()
    {
        $category = $this->owner->category;

        if($category)
        {
            $parents = $category->parents();
            $result = [];
            foreach($parents as $parent)
                $result[] = ['url'=> $parent->path,'label'=>$parent->title];
            $result[] = ['url'=>$category->path,'label'=>$category->title];
            $result[] = $this->title;
        }

        return $result;
    }

    public function getPath()
    {
        $category = $this->owner->category;
        $prefix = is_object($category) ? $category->path : '';
        return $prefix.'/'.$this->owner->alias;
    }

    public function findByPath($path,$separator='/')
    {
        /* @var $page Page */
        $pathList = explode($separator,$path);
        $alias = array_pop($pathList);
        $class = $this->owner;
        $pages = $class::find()->where('alias=:alias',[':alias'=>$alias])->all();

        if(!$pages)
            return null;

        $pathList[]=$alias;

        foreach($pages as $page)
            if($page->getPath() == implode($separator,$pathList))
                return $page;

        return null;
    }
}