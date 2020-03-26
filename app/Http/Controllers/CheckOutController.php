<?php


namespace App\Http\Controllers;


use App\Cart;
use App\Http\Requests\SaveOrderRequest;
use App\Interfaces\ControllerInterface;

class CheckOutController
{

    protected $orderCtrl;
    protected $customerCtrl;

    public function __construct(OrderController $orderController,
                                CustomerController $customerController)
    {
        $this->orderCtrl = $orderController;
        $this->customerCtrl = $customerController;
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function add(SaveOrderRequest $request)
    {
        $customer_id = $this->customerCtrl->add($request);
        $this->orderCtrl->add($request, $customer_id);

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
}
