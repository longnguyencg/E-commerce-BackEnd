<?php


namespace App;


class CartItem
{
    public $product;
    public $totalPrice;
    public $quantity;

    public function __construct($product, $quantity)
    {
        $this->product = $product;
        $this->totalPrice = $product->price * $quantity;
        $this->quantity = $product->quantity;
    }
}
