<?php


namespace App\Services;




use App\Customer;
use App\Interfaces\CustomerServiceInterface;

class CustomerService implements CustomerServiceInterface
{
    protected $customerRepo;

    public function __construct(CustomerServiceInterface $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function store($request)
    {
        dd('a');
        $customer = new Customer();
//        $customer->create($request->all());
        dd($customer);
        return $this->customerRepo->store($customer);
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
