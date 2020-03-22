<?php


namespace App\Http\Controllers;


use App\Http\Requests\StoreProductRequest;
use App\Interfaces\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController
{
    private $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products =$this->productService->getAll();
        return response()->json($products);
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->store($request);
        return response()->json(['success' => 'Created successful'], 200);
    }

    public function update(StoreProductRequest $request, $id)
    {
        $this->productService->update($request, $id);
        return response()->json(['success' => 'Updated successful',200]);
    }

    public function destroy($id)
    {
        if ($this->productService->destroy($id)) {
            return response()->json(['success' => 'Deleted successful',200]);
        }
        return response()->json(['error' => 'Failure delete'], 404);
    }

    public function hidden()
    {

    }

    public function getByCategory($category_id)
    {
        return $this->productService->getByCategory($category_id);
    }
}
