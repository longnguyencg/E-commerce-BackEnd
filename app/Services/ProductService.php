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
        $result = [];
        $products = $this->productRepo->getAll();
        foreach ($products as $product) {
            array_push($result,  array($product, $product->categories));
        }
        return $result;
    }

    public function store($request)
    {
        $product = new Product();
        $product->fill($request->all());
        $this->productRepo->store($product);
        $product->categories()->attach($request->categories);
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
        $this->productRepo->update($product);
        return $product->categories()->sync($request->categories);
    }

    public function destroy($id)
    {
        if ($product = $this->productRepo->findById($id)) {
            return $this->productRepo->destroy($product);
        }
        return false;
    }

    public function getByCategory($category_id)
    {
        $result = [];
        $products = $this->productRepo->getByCategory($category_id);
        foreach ($products as $product) {
            array_push($result, array($product, $product->categories));
        }
        return $result;
    }

    public function hidden($request, $id)
    {
        if ($product = $this->productRepo->findById($id)) {
            $product->display = $request->display == true ? 1 : 0;
            return $this->productRepo->store($product);
        };
        return false;
    }
}
