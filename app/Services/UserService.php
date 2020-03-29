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
        $user = $this->userRepo->findById($id);
        if (Hash::check($request->oldPassword,$user->password)){
            $user->password = Hash::make($request->newPassword);
            $this->userRepo->store($user);
            return response()->json('Successfully');
        }
        else return response()->json('Error');
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
