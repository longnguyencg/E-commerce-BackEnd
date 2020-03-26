<?php


namespace App\Repositories;


use App\Interfaces\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{

    public function store($obj)
    {
        $obj->save();
        return $obj->id;
    }

    public function update($obj)
    {
        // TODO: Implement update() method.
    }

    public function destroy($obj)
    {
        // TODO: Implement destroy() method.
    }
}
