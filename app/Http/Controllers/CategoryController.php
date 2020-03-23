<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryFormRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return Category::all();
    }

    public function show($id)
    {
        if ($category = $this->categoryService->show($id)) {
            return $category;
        }
        return response()->json(['error' => 'No category find'], 404);
    }

    public function add(CategoryFormRequest $request)
    {
        if ($this->categoryService->store($request)) {
            return response()->json(['success' => 'Update category successful'], 200);
        };
        return response()->json(['error' => 'Something wrong']);
    }

    public function update(CategoryUpdateRequest $request)
    {
        if ($this->categoryService->update($request, $request->id)) {
            return response()->json(['success' => 'Update category successful'], 200);
        };
        return response()->json(['error' => 'Something wrong']);
    }

    public function destroy($id)
    {
        if ($category = $this->categoryService->destroy($id)) {
            return response()->json(['success' => 'Deleted successful'], 200);
        }
        return response()->json(['error' => 'No category find'], 404);
    }
}
