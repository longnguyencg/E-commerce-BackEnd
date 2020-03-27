<?php


namespace App\Repositories;


use App\Comment;
use App\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{

    public function __construct()
    {
    }

    public function getCommentProduct($productId)
    {
        return Comment::where('product_id', '=', "$productId")->orderBy('created_at','DESC')->get();
    }

    public function getAll()
    {
        return Comment::orderBy('created_at', 'DESC')->get();
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
