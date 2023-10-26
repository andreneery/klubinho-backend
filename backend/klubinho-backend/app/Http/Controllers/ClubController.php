<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;

class ClubController extends Controller
{
    public function registerClub(Request $request)
    {
        $club = new Club;
        $club->name = $request->name;
        $club->nick_club = $request->nick_club;
        $club->save();

        return response()->json([
            "message" => "Club record created"
        ], 201);
    }
}
