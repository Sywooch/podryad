<?php

namespace app\modules\store\components;

use app\modules\store\models\Product;
use yii\base\Component;
use \Yii;
use yii\db\Expression;


/**
 * Class Basket
 * @package app\modules\store\components
 *
 *
 * @property string $session
 */

class Basket extends Component{

    protected $key = 'basket';
    protected $total = [
        'quantity'=>0,
        'cost'=>0,
    ];

    public function init()
    {
        if(empty(Yii::$app->session[$this->key]))
        {
            Yii::$app->session[$this->key] = [];
        }
    }

    public function getSession()
    {
        return Yii::$app->session[$this->key];
    }

    public function setSession($data)
    {
        Yii::$app->session[$this->key]=$data;
    }

    /**
     * @param $item Product
     */
    public function add($item,$quantity=1,$update=false)
    {
        $session = $this->session;
        if($update && !empty($session[$item->id]))
        {
            if($quantity<$item->minCount)
                $quantity = $item->minCount;

            $session[$item->id]->quantity = $quantity;

        }elseif(!$update && !empty($session[$item->id]))
        {
            $session[$item->id]->quantity += $quantity;
        }else{

            if($quantity<$item->minCount)
                $quantity = $item->minCount;

            $session[$item->id]=(object)['quantity'=>$quantity,'position'=>sizeof($session)+1];
        }
        $this->session = $session;
    }

    public function getItems()
    {
        $session = $this->session;
        $productIds = array_keys($session);
        if(empty($productIds))
            return [];

        $products = Product::find()->where(['id'=>$productIds])
                    ->visible()
                    ->orderBy([
                        new Expression('FIND_IN_SET(id,:productIds)')
                    ])
                    ->addParams([':productIds'=>implode(',',$productIds)])
                    ->all();

        foreach($products as &$product)
        {
            $product->basketQuantity = $session[$product->id]->quantity;
            $this->total['quantity']+=$product->basketQuantity;
        }

        return $products;
    }

    public function getTotalQuantity()
    {
        return $this->total['quantity'];
    }

    public function remove($id)
    {
        $session = $this->session;
        if(empty($session[$id]))
            return false;

        unset($session[$id]);
        $this->session = $session;
    }


}