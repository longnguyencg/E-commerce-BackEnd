<?php


namespace App\Repositories;


use App\Comment;
use App\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{

    public function __construct()
    {
    }

    public function getAll()
    {
        return Comment::all();
    }

    public function store($obj)
    {
        return $obj->save();
    }

    public function update($obj)
    {
        return $obj->save();
    }

    public function delete($obj)
    {
        return $obj->delete();
    }

    public function destroy($obj)
    {
    }
}
