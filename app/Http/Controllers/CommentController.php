<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCommentRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Service\UserService;
use App\Interfaces\CommentServiceInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    protected $cmtService;

    public function __construct(CommentServiceInterface $commentService)
    {
        $this->cmtService = $commentService;
    }

    public function index()
    {
        return $this->cmtService->getAll();
    }

    public function getCommentProduct($id_product)
    {
        return $this->cmtService->getCommentProduct($id_product);
    }

    public function add(AddCommentRequest $request)
    {
        $this->cmtService->store($request);
        return response()->json(['success' => 'Add comment successful'],200);
    }

    public function delete($id)
    {
        $this->cmtService->delete($id);
        return response()->json(['success'=>'Delete successful'],200);
    }

    public function update(UpdateCommentRequest $request)
    {
        $this->cmtService->update($request, $request->id);
        return response()->json(['success'=>'Update successful'],200);
    }

    public function destroy()
    {
        return response()->json(['success'=>'Update successful'],200);
    }
}
