<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Interfaces\ControllerInterface;
use App\Interfaces\OrderServiceInterface;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    protected $orderDtlCtrl;

    public function __construct(OrderServiceInterface $orderService,
                                OrderDetailController $orderDetailController)
    {
        $this->orderService = $orderService;
        $this->orderDtlCtrl = $orderDetailController;
    }

    public function index()
    {
        return Order::all();
    }

    public function add($request, $customer_id)
    {
        $order_id = $this->orderService->store($request->totalPrice, $customer_id);
        $cart = new Cart($request->session()->get('cart'));
        $this->orderDtlCtrl->add($cart, $order_id);
        $notification = new NotificationController();
        $notification->add($order_id);
    }

    public function update($request, $id = null)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function updateStatus(Request $request, $id)
    {
        if ($this->orderService->updateStatus($request, $id)) {
            return response()->json(['success' => 'Updated status successful'],200);
        };

        return response()->json(['error' => 'Order not found'],404);
    }
}
