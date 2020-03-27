<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Interfaces\VoteServiceInterface;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    protected $voteService;

    public function __construct(VoteServiceInterface $voteService)
    {
        $this->voteService = $voteService;
    }

    public function index()
    {
        return $this->voteService->index();
    }

    public function getVoteByUser($user_id, $product_id)
    {
        return $this->voteService->getVoteByUser($user_id,$product_id);
    }

    public function getVoteByProduct($product_id)
    {
        return $this->voteService->getVoteByProduct($product_id);
    }

    public function add(AddVoteRequest $request)
    {
        $this->voteService->store($request);
        return response()->json(['success' => 'Vote successful'],200);
    }

    public function update(UpdateVoteRequest $request)
    {
        $this->voteService->update($request, $request->id);
        return response()->json(['success' => 'update successful'],200);
    }
}
