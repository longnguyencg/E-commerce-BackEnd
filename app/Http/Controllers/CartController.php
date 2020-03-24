<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Coupon;
use App\Http\Requests\UpdateCartRequest;
use App\Product;
use App\Shipping;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public $cart;

    public function __construct()
    {
        $this->cart = new Cart(session()->get('cart'));
    }

    public function index()
    {
        return response()->json($this->cart);
    }

    public function add($idProduct)
    {
        if (Product::find($idProduct)) {
            $this->cart->add($idProduct);
            session()->put('cart', $this->cart);
            return response()->json(['success' => 'Add cart successful'], 200);
        }

        return response()->json(['error' => 'Id product not exists']);
    }

    //Request $request
    public function update(UpdateCartRequest $request)
    {
        $message = $this->cart->update($request->id, $request->quantity);
        session()->put('cart', $this->cart);

        return response()->json($message);
    }

    public function updateCoupon($coupon)
    {
        $message = $this->cart->updateCoupon($coupon);
        session()->put('cart', $this->cart);

        return response()->json($message);
    }

    public function shipping($idShipping)
    {
        $message = $this->cart->updateShip($idShipping);
        session()->put('cart', $this->cart);

        return response()->json($message);
    }

    public function delete($id)
    {
        if (key_exists("$id", $this->cart->listItem)) {
            $this->cart->delete($id);
            session()->put('cart', $this->cart);

            return response()->json(['success' => 'Deleted'], 200);
        }

        return response()->json(['error' => 'The product not exists in cart']);
    }

    public function destroy()
    {
        session()->forget('cart');
        return response()->json(['success' => 'Cleared cart'], 200);
    }
}
