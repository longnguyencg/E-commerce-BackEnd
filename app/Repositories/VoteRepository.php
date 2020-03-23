<?php


namespace App\Repositories;


use App\Interfaces\VoteRepositoryInterface;
use App\Vote;

class VoteRepository implements VoteRepositoryInterface
{

    public function index()
    {
        $count = Vote::count();
        $voteRate = $count > 0 ? Vote::sum('amount') / $count : 0;
        dd(['count'=>$count, 'voteRate'=>$voteRate]);
        return ;
    }

    public function getVoteByUser($id)
    {
        return Vote::where('user_id','=',"$id")->first();
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
        // TODO: Implement destroy() method.
    }
}
