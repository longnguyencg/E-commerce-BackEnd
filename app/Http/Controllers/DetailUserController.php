<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DetailUserController extends Controller
{
    public function index($user_id)
    {
//        return auth()->user()->detailUser();
        $user = User::find($user_id);
        return $user->detailUser();
    }
}
