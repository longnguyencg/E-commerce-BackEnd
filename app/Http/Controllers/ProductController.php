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
        return $this->productService->getAll();
    }

    public function show($id)
    {
        if ($product = $this->productService->show($id)) {
            return $product;
        }

        return response()->json(['error' => 'No data found'], 404);
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->store($request);
        return response()->json(['success' => 'Created successful'], 200);
    }

    public function update(StoreProductRequest $request, $id)
    {
        $this->productService->update($request, $id);
        return response()->json(['success' => 'Updated successful'] , 200);
    }

    public function destroy($id)
    {
        if ($this->productService->destroy($id)) {
            return response()->json(['success' => 'Deleted successful'], 200);
        }
        return response()->json(['error' => 'Failure delete'], 404);
    }

    public function hidden(Request $request, $id)
    {
        if ($request->has('display')) {
            if ($this->productService->hidden($request, $id)) {
                return response()->json(['success' => 'Successful']);
            }
        }

        return response()->json(['error' => 'Something wrong']);
    }

    public function getByCategory($category_id)
    {
        return $this->productService->getByCategory($category_id);
    }
}
