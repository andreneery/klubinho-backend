<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClubIntegrantes;

class ClubIntegrantesController extends Controller
{
    // create a new club integrante
    public function create(Request $request)
    {
        $clubIntegrante = new ClubIntegrantes;
        $clubIntegrante->user_id = $request->user_id;
        $clubIntegrante->club_id = $request->club_id;
        $clubIntegrante->role = $request->role;
        $clubIntegrante->save();
        return response()->json([
            "message" => "Club integrante record created"
        ], 201);
    }

    // get all integrantes by club_id
    public function getAllIntegrantesByClub($club_id)
    {
        if (ClubIntegrantes::where('club_id', $club_id)->exists()) {
            $clubIntegrantes = ClubIntegrantes::where('club_id', $club_id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($clubIntegrantes, 200);
        } else {
            return response()->json([
                "message" => "Club integrantes not found"
            ], 404);
        }
    }

    // update a club integrante by user_id 
    public function updateClubIntegrante(Request $request, $user_id)
    {
        if (ClubIntegrantes::where('user_id', $user_id)->exists()) {
            $clubIntegrante = ClubIntegrantes::find($user_id);
            $clubIntegrante->user_id = $request->user_id;
            $clubIntegrante->club_id = $request->club_id;
            $clubIntegrante->role = $request->role;
            $clubIntegrante->save();

            return response()->json([
                "message" => "Club integrante updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Club integrante not found"
            ], 404);
        }
    }

}
