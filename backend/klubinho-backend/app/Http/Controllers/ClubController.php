<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ClubController extends Controller
{
    public function registerClub(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nick_club' => 'required|unique:clubs,nick_club',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Nick Club already exists'
            ], 401);
        }

        $club = new Club;
        $club->name = $request->name;
        $club->nick_club = $request->nick_club;
        $club->description = $request->description;
        $club->banner = $request->banner;
        $club->user_id = $request->user_id;
        $club->save();

        return response()->json([
            'club' => $club,
            "message" => "Club record created"
        ], 201);
    }
}
