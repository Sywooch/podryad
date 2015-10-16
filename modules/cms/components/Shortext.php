<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 21.07.15
 * Time: 11:41
 */

namespace app\modules\cms\components;


use yii\base\Behavior;

class Shortext extends Behavior{

    public $attribute = 'description';

    public function shortext($length)
    {
        $text = $this->owner{$this->attribute};
        $items = explode(' ',$text);
        $result = [];
        $counter = 0;
        foreach($items as $item)
        {
            $result[]=$item;
            $counter += mb_strlen($item);
            if($counter>=$length)
                break;
        }
        if($counter>=$length)
            return implode(' ',$result).' ...';
        else
            return $text;
    }

}