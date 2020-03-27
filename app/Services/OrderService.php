<?php


namespace App\Services;


use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\OrderServiceInterface;
use App\Order;

class OrderService implements OrderServiceInterface
{
    protected $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function show($id)
    {
        return $this->orderRepo->show($id);
    }

    public function store($totalPrice, $customer_id)
    {
        $order = new Order();
        $order->totalPrice = $totalPrice;
        $order->customer_id = $customer_id;

        return $this->orderRepo->store($order);
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function updateStatus($request, $id)
    {
        if ($order = $this->orderRepo->show($id)) {
            $order->status = $request->status;
            return $this->orderRepo->update($order);
        }

        return false;
    }
}
