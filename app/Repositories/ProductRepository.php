<?php


namespace App\Repositories;


use App\Product;

class ProductRepository
{

    public function getAll()
    {
        return Product::all();
    }

    public function findById($id)
    {
        return Product::findOrFail($id);
    }

    public function store($request)
    {
        return Product::create($request->all());
    }

    public function destroy($product)
    {
        $product->delete();
    }

    public function update($product)
    {
        $product->save();
    }
}
