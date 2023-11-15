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

    // get reuniao by id
    public function getReuniao($id)
    {
        if (Reuniao::where('id', $id)->exists()) {
            $reuniao = Reuniao::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
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
        $reuniao->reuniao_id = $request->reuniao_id;
        $reuniao->content = $request->content;
        $reuniao->save();
        return response()->json([
            "message" => "Comment record created"
        ], 201);
    }

    public function getAllCommentsByReuniao($reuniao_id)
    {
        if (Reuniao::where('reuniao_id', $reuniao_id)->exists()) {
            $reuniao = Reuniao::where('reuniao_id', $reuniao_id)
                ->join('users', 'reuniao_comments.user_id', '=', 'users.id')
                ->select('reuniao_comments.*', 'users.name', 'users.last_name', 'users.imagem')
                ->get()->toJson(JSON_PRETTY_PRINT);
            return response($reuniao, 200);
        } else {
            return response()->json([
                "message" => "Comment not found"
            ], 404);
        }
    }
}
