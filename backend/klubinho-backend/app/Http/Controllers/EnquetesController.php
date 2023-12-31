<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquetes;

class EnquetesController extends Controller
{
    public function create(Request $request)
    {
        $enquete = new Enquetes;
        $enquete->user_id = $request->user_id;
        $enquete->club_id = $request->club_id;
        $enquete->title = $request->title;
        $enquete->description = $request->description;
        $enquete->votes = $request->votes;
        $enquete->status = $request->status;
        $enquete->save();
        return response()->json([
            "message" => "Enquete record created"
        ], 201);
    }

    // get all enquetes by club_id
    public function getAllEnquetesByClub($club_id)
    {
        if (Enquetes::where('club_id', $club_id)->exists()) {
            $enquete = Enquetes::where('club_id', $club_id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($enquete, 200);
        } else {
            return response()->json([
                "message" => "Enquete not found"
            ], 404);
        }
    }

    //alter status enquete
    public function alterStatusEnquete(Request $request, $id)
    {
        if (Enquetes::where('id', $id)->exists()) {
            $enquete = Enquetes::find($id);
            $enquete->status = $request->status;
            $enquete->save();

            return response()->json([
                "message" => "Enquete updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Enquete not found"
            ], 404);
        }
    }
}
