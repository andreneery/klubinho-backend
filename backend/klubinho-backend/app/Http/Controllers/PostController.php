<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    // creste a post
    public function createPost(Request $request)
    {
        $token = string;
        $post = new Post;
        $post->content = $request->content;
        $token = $request->token;
        $foreignId = User::findIdByToken($token);
        $post->save();;

        return response()->json([
            "message" => "Post record created"
        ], 201);
    }

    // delete a post
    public function deletePost($id)
    {
        if(Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->delete();

            return response()->json([
                "message" => "Post deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Post not found"
            ], 404);
        }
    }
}