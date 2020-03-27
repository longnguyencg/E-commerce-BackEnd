<?php


namespace App\Services;


use App\Interfaces\VoteRepositoryInterface;
use App\Interfaces\VoteServiceInterface;
use App\Vote;

class VoteService implements VoteServiceInterface
{
    protected $voteRepo;

    public function __construct(VoteRepositoryInterface $voteRepository)
    {
        $this->voteRepo = $voteRepository;
    }

    public function index()
    {
        return $this->voteRepo->index();
    }

    public function store($request)
    {
        $vote = Vote::create($request->all());
        return $this->voteRepo->store($vote);
    }

    public function getVoteByUser($user_id, $product_id)
    {
        return $this->voteRepo->getVoteByUSer($user_id, $product_id);
    }

    public function getVoteByProduct($product_id)
    {
        return $this->voteRepo->getVoteByProduct($product_id);
    }

    public function update($request, $id)
    {
        $vote = Vote::find($id);
        $vote->amount = $request->amount;
        return $this->voteRepo->update($vote);
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
