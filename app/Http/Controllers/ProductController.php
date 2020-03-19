<?php


namespace App\Http\Controllers;


use App\Http\Requests\StoreProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return $this->productService->getAll();
    }

    public function findById()
    {

    }

    public function store(Request $request)
    {
        $this->productService->store($request);
        return response()->json(['success' => 'Tạo thành công'], 200);
    }

    public function update(Request $request, $id)
    {
        $this->productService->update($request, $id);
        return response()->json(['success' => 'Update successful',200]);
    }

    public function destroy($id)
    {
        if ($this->productService->destroy($id)) {
            return response()->json(['success' => 'Delete successful',200]);
        }
        return response()->json(['error' => 'Failure delete'], 404);
    }

    public function hidden()
    {

    }
}
