<?php


namespace App;


class Cart
{
    public $listItem = [];
    public $totalTypeOfProduct = 0;
    public $coupon = [];
    public $shipping = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
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
        if (!key_exists("$idProduct", $this->listItem)) {
            $cartItem = new CartItem(Product::find($idProduct),1);
            $this->listItem["$idProduct"] = $cartItem;
            $this->totalTypeOfProduct++;
            $this->totalPrice += $cartItem->totalPrice;
        }
    }

    public function update($idProduct, $quantity)
    {
        if (key_exists("$idProduct", $this->listItem)) {
            $cartItem = new CartItem(Product::find($idProduct),$quantity);
            $this->totalPrice += $cartItem->totalPrice - $this->listItem["$idProduct"]->totalPrice;
            $this->listItem["$idProduct"] = $cartItem;
        }
    }

    public function updateCoupon($coupon)
    {
        if ($coupon = Coupon::where('name','=',$coupon)->first()) {
            array_push($this->coupon,$coupon->id);
            if ($coupon->type === "%") {
                $this->totalPrice *= (100 - $coupon->amount)/100;
            } else {
                $this->totalPrice -= $coupon->amount;
            }
        }
    }

    public function updateShip($id)
    {
        if ($shipping = Shipping::find($id)) {
            $this->shipping = $shipping->amount;
            $this->totalPrice -= $this->shipping;
        }
    }

    public function delete($id)
    {
        $this->listItem["$id"] = null;
        $this->totalTypeOfProduct--;
    }
}
