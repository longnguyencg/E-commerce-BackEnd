<?php


namespace App\Interfaces;


interface OrderServiceInterface
{
    public function store($cart, $customer_id);
}
