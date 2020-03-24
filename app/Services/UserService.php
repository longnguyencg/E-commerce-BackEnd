<?php


namespace App\Services;


use App\Interfaces\ServiceInterface;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserService implements ServiceInterface
{
    protected $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function store($request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $this->userRepo->store($user);
    }
    public function findById($id) {
        return $this->userRepo->findById($id);
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
