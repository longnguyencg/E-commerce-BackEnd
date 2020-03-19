<?php


namespace App\Services;


use App\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function findById($id)
    {
        return $this->productRepo->findById($id);
    }

    public function getAll()
    {
        return $this->productRepo->getAll();
    }

    public function store($request)
    {
        $this->productRepo->store($request);
    }

    public function update($request, $id)
    {
        $product = $this->productRepo->findById($id);
        $product->update($request->all());
        $this->productRepo->update($product);
    }

    public function destroy($id)
    {
        if ($product = $this->productRepo->findById($id)) {
            $this->productRepo->destroy($product);
            return true;
        }
        return false;
    }
}
