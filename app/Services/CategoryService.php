<?php


namespace App\Services;


use App\Category;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function show($id)
    {
        return $this->categoryRepo->show($id);
    }

    public function store($request)
    {
        $category = Category::create($request->all());
        return $this->categoryRepo->store($category);
    }

    public function update($request, $id)
    {
        if ($category = $this->categoryRepo->show($id)) {
            $category->name = $request->name;
            return $this->categoryRepo->update($category);
        }
        return false;
    }

    public function destroy($id)
    {
        if ($category = $this->categoryRepo->show($id)) {
            $category->products()->detach();
            return $this->categoryRepo->destroy($category);
        }
        return false;
    }
}
