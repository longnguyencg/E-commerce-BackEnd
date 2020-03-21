<?php


namespace App;


class Cart
{
    public $listItem = [];
    public $totalTypeOfProduct = 0;
    public $coupon = 0;
    public $totalPrice = 0;

    public function __construct($oldCart = null)
    {
        if ($oldCart) {
            $this->listItem = $oldCart->listItem;
            $this->totalTypeOfProduct = $oldCart->totalTypeOfProduct;
            $this->coupon = $oldCart->coupon;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($idProduct)
    {
        if (!$this->listItem[$idProduct]) {
            $cartItem = new CartItem(Product::find($idProduct),1);
            $this->listItem[$idProduct] = $cartItem;
            $this->totalTypeOfProduct++;
            $this->totalPrice += $cartItem->totalPrice;
        }
    }

    public function update($idProduct, $quantity)
    {
        if ($this->listItem[$idProduct]) {
            $cartItem = new CartItem(Product::find($idProduct),$quantity);
            $this->totalPrice += $cartItem->totalPrice - $this->listItem[$idProduct]->totalPrice;
            $this->listItem[$idProduct] = $cartItem;
        }
    }

    public function updateCoupon($coupon)
    {
        $this->coupon = $coupon;
        $this->totalPrice *= (100 - $this->coupon)/100;
    }

    public function delete($id)
    {
        $this->listItem[$id] = null;
    }
}
