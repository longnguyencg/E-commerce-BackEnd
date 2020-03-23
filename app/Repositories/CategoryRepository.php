<?php


namespace App\Repositories;


use App\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function show($id)
    {
        return Category::find($id);
    }

    public function store($obj)
    {
        return $obj->save();
    }

    public function update($obj)
    {
        return $obj->save();
    }

    public function destroy($obj)
    {
        return $obj->delete();
    }
}
