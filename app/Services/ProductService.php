<?php


namespace App\Services;


use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductServiceInterface;
use App\Product;
use App\Repositories\ProductRepository;

class ProductService implements ProductServiceInterface
{
    private $productRepo;

    public function __construct(ProductRepositoryInterface $productRepository)
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
        $product = new Product();
        $product->fill($request->all());
        $this->productRepo->store($product);
    }

    public function show($id)
    {
        if ($product = $this->productRepo->findById($id)) {
            return $product;
        }

        return false;
    }

    public function update($request, $id)
    {
        $product = $this->productRepo->findById($id);
        $product->update($request->all());
        return $this->productRepo->update($product);
    }

    public function destroy($id)
    {
        if ($product = $this->productRepo->findById($id)) {
            $this->productRepo->destroy($product);
            return true;
        }
        return false;
    }

    public function getByCategory($category_id)
    {
        return $this->productRepo->getByCategory($category_id);
    }

    public function hidden($request, $id)
    {
        if ($product = $this->productRepo->findById($id)) {
            $product->display = $request->display;
            $this->productRepo->update($product);
            return true;
        };
        return false;
    }
}
