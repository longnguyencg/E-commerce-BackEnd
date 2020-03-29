<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register(Request $request) {
        $this->userService->store($request);
    }
    public function findById($id) {
        $user = $this->userService->findById($id);
        return response()->json($user);
    }
    public function update(Request $request) {
       return $this->userService->update($request,$request->id);
    }
}
