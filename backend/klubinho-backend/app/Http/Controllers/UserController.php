<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function create(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;

        $user->save();

        return response()->json($user);
    }

    public function showUserByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return response()->json($user);
    }
}
