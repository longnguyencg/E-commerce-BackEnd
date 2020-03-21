<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use function Psy\sh;

class CartController extends Controller
{
    protected $cart;

    public function __construct()
    {
        $this->cart = new Cart(session()->get('cart'));
    }

    public function index()
    {
        dd($this->cart);
        return $this->cart;
    }

    public function add($idProduct)
    {
        $this->cart->add($idProduct);
        session()->put('cart', $this->cart);
    }

    //Request $request
    public function update($idProduct, $quantity)
    {
        $this->cart->update($idProduct, $quantity);
        session()->put('cart', $this->cart);
    }

    public function updateCoupon($coupon) {
        $this->cart->updateCoupon($coupon);
        session()->put('cart', $this->cart);
    }

    public function shipping($id)
    {
        $this->cart->updateShip($id);
        session()->put('cart', $this->cart);
    }

    public function delete($id)
    {
        $this->cart->delete($id);
        session()->put('cart', $this->cart);
    }

    public function destroy()
    {
        session()->forget('cart');
    }
}
