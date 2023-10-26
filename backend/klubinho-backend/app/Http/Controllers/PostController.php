<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // creste a post
    public function createPost(Request $request)
    {
        $post = new Post;
        $post->club_id = $request->club_id;
        $post->content = $request->content;
        $post->save();

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