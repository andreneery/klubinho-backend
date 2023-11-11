<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\User;

class ClubController extends Controller
{
    public function registerClub(Request $request)
    {
        $club = new Club;
        $club->name = $request->name;
        $club->nick_club = $request->nick_club;
        $club->user_id = $request->user_id;
        $club->save();
        // update user role to admin
        $user = User::find($request->user_id);
        $user->role = 'admin';
        $user->save();

        return response()->json([
            "message" => "Club record created",
            "club" => $club
        ], 201);
    }
}
