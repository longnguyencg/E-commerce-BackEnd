<?php


namespace App\Http\Controllers;


use App\Cart;
use App\Customer;
use App\Http\Requests\SaveOrderRequest;
use App\Interfaces\ControllerInterface;
use App\Interfaces\CustomerServiceInterface;
use App\Interfaces\OrderServiceInterface;
use App\Order;
use App\Services\CustomerService;
use App\User;

class CheckOutController
{

    protected $orderSvc;
    protected $customerSvc;

    public function __construct(CustomerServiceInterface $customerService)
    {
//        $this->orderSvc = $orderService;
        $this->customerSvc = $customerService;
    }

    public function getTimeOrders()
    {

    }

    public function getOrderByTime()
    {

    }

    public function show($order_id)
    {
        return;
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function add(SaveOrderRequest $request)
    {
        dd('a');
        $customer_id = $this->customerSvc->store($request);
//        $this->orderSvc->store($request, $customer_id);

        return response()->json(['success' => 'Ordered successful'],200);
    }

    public function update($request, $id = null)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function history($email)
    {
        if ($customer  = Customer::where('email','=',"$email")->first()) {
            return Order::where('customer_id','=', $customer->id);
        }

        return response()->json(['error' => 'No user exists'],404);
    }
}
