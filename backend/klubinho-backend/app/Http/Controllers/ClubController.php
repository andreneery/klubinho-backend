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

    // find club by nick_club and return club_id and name
    public function findClubByNickClub($nick_club)
    {
        if (Club::where('nick_club', $nick_club)->exists()) {
            $club = Club::where('nick_club', $nick_club)->get()->toJson(JSON_PRETTY_PRINT);
            return response($club, 200);
        } else {
            return response()->json([
                "message" => "Club not found"
            ], 404);
        }
    }
}
