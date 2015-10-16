<?php
/**
 * Created by PhpStorm.
 * User: ivphpan
 * Date: 28.07.15
 * Time: 16:03
 */

namespace app\modules\store\components;


use yii\base\Behavior;

class BasketBehavior extends Behavior{

    protected $basketPrice;
    protected $basketQuantity;
    protected $basketTotal;

    public function setBasketprice($value)
    {
        $this->basketPrice = $value;
    }

    public function getBasketprice()
    {
        return $this->basketPrice;
    }

    public function setBasketquantity($value)
    {
        $this->basketQuantity = $value;
    }

    public function getBasketquantity()
    {
        return $this->basketQuantity;
    }

}