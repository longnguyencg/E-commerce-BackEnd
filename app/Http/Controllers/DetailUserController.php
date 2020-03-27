<?php

namespace App\Http\Controllers;

use App\DetailUser;
use App\Http\Requests\DetailUserRequest;
use App\User;
use Illuminate\Http\Request;

class DetailUserController extends Controller
{
    public function index($user_id)
    {
//        return auth()->user()->detailUser();
        return DetailUser::where('user_id','=',"$user_id")->first();
    }

    public function add(DetailUserRequest $request)
    {
        $detailUser = new DetailUser();
        $detailUser->create($request->all());
        if ($detailUser->save()) {
            return response()->json(['success' => 'Created detail user'],200);
        };

        return response()->json(['error' => 'Something wrong']);
    }

    public function update(DetailUserRequest $request)
    {
        $detailUser = DetailUser::where('user_id','=',"$request->user_id")->first();
        $detailUser->update($request->all());
        if ($detailUser->save()) {
            return response()->json(['success' => 'Updated detail user'],200);
        };
        return response()->json(['error' => 'Something wrong']);
    }
}
