<?php


namespace App\Services;


use App\Comment;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\CommentServiceInterface;
use http\Env\Request;

class CommentService implements CommentServiceInterface
{
    protected $cmtRepo;
    protected $userService;

    public function __construct(CommentRepositoryInterface $commentRepo, UserService $userService)
    {
        $this->cmtRepo = $commentRepo;
        $this->userService = $userService;
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

    public function getCommentProduct($productId)
    {
        $cmts = $this->cmtRepo->getCommentProduct($productId);
        $comments = [];
        foreach ($cmts as $cmt) {
            $comment = new \stdClass();
            $comment->id = $cmt->id;
            $comment->product_id = $cmt->product_id;
            $comment->user = $this->userService->findById($cmt->user_id);
            $comment->content = $cmt->content;
            $comment->created_at = $cmt->created_at;
            $comment->updated_at = $cmt->updated_at;
            array_push($comments,$comment);
    }
        return $comments;
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
