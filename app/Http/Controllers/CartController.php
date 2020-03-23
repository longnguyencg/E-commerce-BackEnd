<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\UpdateCartRequest;
use App\test;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;
use function Psy\sh;

class CartController extends Controller
{
    public $cart;

    public function __construct()
    {
        $this->cart = new Cart(session()->get('cart'));
    }

    public function index()
    {
        return array($this->cart);
    }

    public function add($idProduct)
    {
        $this->cart->add($idProduct);
        session()->put('cart', $this->cart);
    }

    //Request $request
    public function update(UpdateCartRequest $request)
    {
        if ($request->id && $request->quantity) {
            $this->cart->update($request->id, $request->quantity);
            session()->put('cart', $this->cart);
        }
    }

    public function updateCoupon($coupon) {
        $this->cart->updateCoupon($coupon);
        session()->put('cart', $this->cart);
    }

    public function shipping($idShipping)
    {
        $this->cart->updateShip($idShipping);
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
