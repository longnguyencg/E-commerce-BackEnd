<?php


namespace App\Repositories;


use App\Interfaces\ProductRepositoryInterface;
use App\Product;

class ProductRepository implements ProductRepositoryInterface
{

    public function getAll()
    {
        return Product::all();
    }

    public function findById($id)
    {
        return Product::find($id);
    }

    public function store($product)
    {
        $product->save();
    }

    public function destroy($product)
    {
        $product->delete();
    }

    public function update($product)
    {
        $product->save();
    }

    public function getByCategory($category_id)
    {
        $product = new Product();
        return $product->where('category_id','=',"$category_id")->get();
    }
}
