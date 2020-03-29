<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Interfaces\CustomerServiceInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }
    public function add($request)
    {
        dd('a');
        return $this->customerService->store($request);
    }
}
