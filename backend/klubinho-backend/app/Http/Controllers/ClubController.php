<?php

namespace App\Http\Controllers;

use App\Models\club;
use Illuminate\Http\Request;

class ClubController extends Controller
{

    public function create(Request $request)
    {
        $club = new club();
        $club->name = $request->name;
        $club->club_name = $request->club_name;

        $club->save();

        return response()->json($club);
    }


    public function showClubByClubName($club_name)
    {
        $club = club::where('club_name', $club_name)->first();
        return response()->json($club);
    }


    public function update(Request $request, club $club)
    {
        $club->name = $request->name;
        $club->club_name = $request->club_name;
        $club->description = $request->description;
        $club->banner = $request->banner;
    }

    public function updateById(Request $request, $id)
    {
        $club = club::find($id);
        $club->name = $request->name;
        $club->club_name = $request->club_name;
        $club->description = $request->description;
        $club->banner = $request->banner;
        $club->save();
    }

    public function updateByClubName(Request $request, $club_name)
    {
        $club = club::where('club_name', $club_name)->first();
        $club->name = $request->name;
        $club->club_name = $request->club_name;
        $club->description = $request->description;
        $club->banner = $request->banner;
        $club->save();
    }

    public function deleteById($id)
    {
        $club = club::find($id);
        $club->delete();
    }
}
