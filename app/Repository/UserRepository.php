<?php


namespace App\Repository;


use App\User;

class UserRepository
{
    protected $user;
public function __construct(User $user)
{
    $this->user = $user;
}
public function store($user) {
    $user->save();
}
public function findById($id) {
    return $this->user->findOrFail($id);
}
}
