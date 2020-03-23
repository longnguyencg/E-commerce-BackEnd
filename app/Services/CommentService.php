<?php


namespace App\Services;


use App\Comment;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\CommentServiceInterface;
use http\Env\Request;

class CommentService implements CommentServiceInterface
{
    protected $cmtRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->cmtRepo = $commentRepo;
    }

    public function getAll()
    {
        return $this->cmtRepo->getAll();
    }

    public function store($request)
    {
        $cmt = Comment::create($request->all());
        $this->cmtRepo->store($cmt);
    }

    public function update($request, $id)
    {
        $cmt = Comment::find($id);
        $cmt->content = $request->content;
        return $this->cmtRepo->update($cmt);
    }

    public function delete($id)
    {
        $cmt = Comment::find($id);
        return $this->cmtRepo->delete($cmt);
    }

    public function destroy($request)
    {

    }
}
