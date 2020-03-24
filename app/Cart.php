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
            $this->shipping = $oldCart->shipping;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($idProduct)
    {
        if (!key_exists("$idProduct", $this->listItem)) {
            $cartItem = new CartItem(Product::find($idProduct), 1);
            $this->listItem["$idProduct"] = $cartItem;
            $this->totalTypeOfProduct++;
            $this->totalPrice += $cartItem->totalPrice;
        }
    }

    public function update($idProduct, $quantity)
    {
        if (key_exists("$idProduct", $this->listItem)) {
            $cartItem = new CartItem(Product::find($idProduct), $quantity);
            $this->totalPrice += $cartItem->totalPrice - $this->listItem["$idProduct"]->totalPrice;
            $this->listItem["$idProduct"] = $cartItem;

            return array('success' => 'Updated cart successful');
        }

        return array('error' => 'The product not exists in cart');
    }

    public function updateCoupon($coupon)
    {
        if ($coupon = Coupon::where('name', '=', $coupon)->first()) {
            if ($this->totalPrice < $coupon->amount) {
                return array('error' => 'The coupon\'s value is over than product price, please buy plus to continue');
            }

            if (in_array($coupon->id, $this->coupon)) {
                return array('error' => 'You used the coupon');
            }

            array_push($this->coupon, $coupon->id);
            if ($coupon->type === "%") {
                $this->totalPrice *= (100 - $coupon->amount) / 100;
            } else {
                $this->totalPrice -= $coupon->amount;
            }
            return array('success' => 'Updated coupon successful');
        }

        return array('error' => 'The coupon not exists');
    }

    public function updateShip($id)
    {

        if ($shipping = Shipping::find($id)) {
            if ($shipping->amount === $this->shipping) {
                return array('success' => 'Update cart successful');
            }
            $this->shipping = $shipping->amount;
            $this->totalPrice += $this->shipping;
            return array('success' => 'Update cart successful');
        }

        return array('error' => 'The id shipping not exists');
    }

    public function delete($id)
    {
        $this->totalPrice -= $this->listItem["$id"]->totalPrice;
        $this->totalTypeOfProduct--;
        unset($this->listItem["$id"]);
    }
}
