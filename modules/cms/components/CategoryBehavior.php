<?php

namespace app\modules\cms\components;

use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\base\Behavior;
use yii\helpers\Url;

class CategoryBehavior extends Behavior{

    public $prefix = '';
    public $itemClass = '';
    public $itemParentField = 'parentId';
    public $itemWith=[];
    public $route;

    static $parentList = [];
    static $parentData = [];

    public function getParents()
    {
        if(!empty(self::$parentList))
            return self::$parentList;

        /* @var $items Page[] */
        $class = $this->owner->className();
        $items = $class::find()->all();

        if(!$items)
            return false;

        foreach($items as $item)
        {
            self::$parentList[$item->parentId][$item->id] = $item;
            self::$parentData[$item->id]=$item;
        }

        return $this->getParents();
    }

    public function dropdown($all = true,$notId = null)
    {
        $data = $this->getParents();
        $results = $tree = [];
//        $results[0] = ' --- ';
        self::makeTree($data, ($all ? 0 : $this->owner->id), $tree);
        /* if($this->owner->isNewRecord)
         {*/
        foreach ($tree as $item) {
            if ($notId == $item->id)
                continue;

            $title = $item->level ? str_repeat('-', $item->level - 1) . ' ' . $item->title : $item->title;
            $results[$item->id] = $title;
        }
        /*}else
        {
            if($this->owner->parent)
            {
                $results[$this->owner->parent->id] = $this->owner->parent->title;
            }
            if(!empty($tree[$this->owner->parentId]))
            {
                foreach ($tree[$this->owner->parentId] as $item) {
                    $results[$item->id] = str_repeat('-', $item->level - 1) . ' ' .$item->title;
                }
            }
        }*/

        return $results;
    }

    public static function makeTree($data,$parentId,&$result)
    {
        static $level;
        if(!empty($data[$parentId]))
        {
            foreach($data[$parentId] as $item)
            {
                ++$level;
                $item->level = $level;
                $result[] = $item;

                self::makeTree($data,$item->id,$result);
                --$level;
            }
        }
    }

    protected function parentData()
    {
        /* @var $items Page[] */
        if(!empty(self::$parentData))
            return self::$parentData;

        $this->getParents();

        return $this->parentData();
    }

    public function parents()
    {
        $results = [];
        $parents = $this->parentData();

        if(empty($parents))
            return $results;

        $this->makeParentTree($parents,$this->owner->parentId,$results);
        $results = array_reverse($results);
        return $results;
    }

    protected function makeParentTree($data,$parentId,&$result)
    {
        if(!empty($data[$parentId]))
        {
            $item = $data[$parentId];
            $result[$item->id] = $item;
            $this->makeParentTree($data,$item->parentId,$result);
        }
        return false;
    }

    public function getFullPath()
    {
        $data = [];
        $parents = $this->parents();
        foreach($parents as $parent)
        {
            $data[] = $parent->alias;
        }
        $data[]=$this->owner->alias;
        return implode('/',$data);
    }

    public function getFullTitle($separator = ' - ')
    {
        $parents = $this->parents();
        $data = [];
        foreach($parents as $parent)
        {
            $data[] = $parent->title;
        }
        $data[] = $this->owner->title;
        return implode($separator,$data);
    }

    public function children()
    {
        $this->getParents();
        $result = [];
        if(!empty(self::$parentList[$this->owner->id]))
            $result = self::$parentList[$this->owner->id];
        return $result;
    }

    public function childrens()
    {
        $result = [];
        $data = $this->getParents($this->owner->id);
        self::makeTree($data,$this->owner->id,$result);
        return $result;
    }

    public function findByFullPath($path,$separator='/')
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
            if($page->getFullPath() == implode($separator,$pathList))
                return $page;

        return null;
    }

    public function breadcrumbs($params=[])
    {
        /* @var $parents Page[] */

        $data = [];
        $parents = $this->parents();
        foreach($parents as $parent)
        {
            $data[] = [
                'class'=> !empty($params['itemClass']) ? $params['itemClass'] : '',
                'label'=>$parent->title,
                'url'=>Url::to([$this->route,'path'=>$parent->getFullPath()])
            ];
        }
        $data[]=[
            'label'=>$this->owner->title,
            'url'=>'#',
            'class'=>!empty($params['currentClass']) ? $params['currentClass'] : '',
        ];
        return $data;
    }

    public function getItems($params=[])
    {

        $pageSize = !empty($params['pageSize']) ? $params['pageSize'] : 15;

        $idList = [];
        $idList[]=$this->owner->id;

        foreach($this->childrens() as $children)
        {
            $idList[]=$children->id;
        }
        $childClassName = $this->itemClass;
        $query = $childClassName::find()->with($this->itemWith)->where([$this->itemParentField=>$idList]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>$pageSize]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id DESC')
            ->all();

        return (object)[
            'models' => $models ? $models : [],
            'pages' => $pages ? $pages : [],
        ];
    }

    public function getArrayDataProvider()
    {
        $results = [];
        $data = $this->getParents();
        $this->makeTree($data,0,$results);
        return new ArrayDataProvider([
            'key'=>'id',
            'allModels'=>$results
        ]);
    }

    public function getSiblings($limit=null)
    {
        $class = $this->owner;
        $query = $class->find()->where('parentId=:parentId and id<>:id',[
            ':parentId'=>$this->owner->parentId,
            ':id'=>$this->owner->id,
        ]);
        if($limit)
            $query->limit($limit);
        return $query->all();
    }
}
