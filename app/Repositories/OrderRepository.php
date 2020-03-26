<?php


namespace App\Repositories;


use App\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{

    public function store($obj)
    {
        $obj->save();
        return $obj->id;
    }

    public function update($obj)
    {
        return $obj->save();
    }

    public function destroy($obj)
    {
        return $obj->delete();
    }
}
