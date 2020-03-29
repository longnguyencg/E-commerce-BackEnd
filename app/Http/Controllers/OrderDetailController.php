<?php

namespace App\Http\Controllers;

use App\Interfaces\OrderDetailControllerInterface;
use App\OrderDetail;
use Illuminate\Http\Request;

class  OrderDetailController extends Controller implements OrderDetailControllerInterface
{
    public function add($cart, $order_id)
    {
        if (count($cart->listItem) === 0 ) {
            return false;
        }
        foreach($cart->listItem as $product_id => $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order_id;
            $orderDetail->product_id = $product_id;
            $orderDetail->quantity = $item->quantity;
            $orderDetail->price = $item->product->price;

            $orderDetail->save();
        }

        return true;
    }
}
