<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Customer;
use App\Http\Requests\SaveOrderRequest;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckOutController extends Controller
{
    public function index()
    {
    }

    public function add(SaveOrderRequest $request)
    {
        if (!$customer = Customer::where('email','=',$request->email)->first()) {
            $customer = Customer::create($request->all());
            $customer->save();
        }

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->total_price = 0;
        $order->save();
        $sum = 0;
        foreach ($request->cart as $item) {
            $order_detail = new OrderDetail();
            $product = Product::find($item[0]);
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item[0];
            $order_detail->quantity = $item[1];
            $order_detail->price = $product->price;
            $order_detail->save();
            $sum += $order_detail->quantity * $order_detail->price;
        }
        $order->total_price = $sum;
        $order->save();
    }

    public function update(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->comment  = $request->comment;
        $order->save();
    }

    public function history(Request $request)
    {
        $order = Order::where('email','=',$request->email);
        return $order;
    }

    public function getTimeOrders()
    {
        $sql = DB::raw("DATE(created_at) as order_date");
        return Product::select($sql)->groupBy('order_date')->get();
    }

    public function getOrdersByTime(Request $request)
    {
        $sql = DB::raw("DATE(products.created_at) as order_date");
        $date = "$request->date";
        $dates = explode('-',$date);
        $dates[count($dates)-1]++;
        $date = implode('-',$dates);
        return Product::select('*')
                        ->whereDate('created_at','>=', $request->date)
                        ->whereDate('created_at','<', $date)
                        ->get() ;
    }

    public function show($id)
    {
        $order = Order::find($id);
        $orders = $order->customer;
        $order_details = $order->order_details;
        return array($orders, $order_details);
    }
}
