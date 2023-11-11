<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reuniao;

class ReuniaoController extends Controller
{

    public function createReuniao(Request $request)
    {
        $reuniao = new Reuniao;
        $reuniao->titulo = $request->titulo;
        $reuniao->descricao = $request->descricao;
        $reuniao->link = $request->link;
        $reuniao->data_reuniao = $request->data_reuniao;
        $reuniao->hora_reuniao = $request->hora_reuniao;
        $reuniao->livro = $request->livro;
        $reuniao->autor = $request->autor;
        $reuniao->club_id = $request->club_id;
        $reuniao->user_id = $request->user_id;
        $reuniao->save();

        return response()->json([
            "message" => "Reuniao record created",
            "reuniao" => $reuniao
        ], 201);
    }

    public function getAllReuniaoByClub($club_id)
    {
        if (Reuniao::where('club_id', $club_id)->exists()) {
            $reuniao = Reuniao::where('club_id', $club_id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($reuniao, 200);
        } else {
            return response()->json([
                "message" => "Reuniao not found"
            ], 404);
        }
    }

    public function createComment(Request $request)
    {
        $reuniao = new Reuniao;
        $reuniao->user_id = $request->user_id;
        $reuniao->club_id = $request->club_id;
        $reuniao->content = $request->content;
        $reuniao->save();
        return response()->json([
            "message" => "Comment record created"
        ], 201);
    }

    public function getAllCommentsByClub($club_id)
    {
        if (Reuniao::where('club_id', $club_id)->exists()) {
            $reuniao = Reuniao::where('club_id', $club_id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($reuniao, 200);
        } else {
            return response()->json([
                "message" => "Comment not found"
            ], 404);
        }
    }
}
