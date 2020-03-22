<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddVoteRequest;
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

    public function getVoteByUser($id)
    {
        return $this->voteService->getVoteByUser($id);
    }

    public function add(AddVoteRequest $request)
    {
        $this->voteService->store($request);
        return response()->json(['success' => 'Vote successful'],200);
    }

    public function update(Request $request)
    {
        $this->voteService->update($request, $request->id);
        return response()->json(['success' => 'update successful'],200);
    }
}
