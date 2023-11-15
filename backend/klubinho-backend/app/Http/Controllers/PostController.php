<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // creste a post
    public function createPost(Request $request)
    {
        $post = new Post;
        $post->user_id = $request->user_id;
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

    // geat all post by user
    public function getAllPostByUser($id)
    {
        if(Post::where('id', $id)->exists()) {
            $post = Post::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($post, 200);
        } else {
            return response()->json([
                "message" => "Post not found"
            ], 404);
        }
    }

    // get all post by club_id
    public function getAllPostByClub($id)
    {
        if(Post::where('club_id', $id)->exists()) {
            $post = Post::where('club_id', $id)
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name', 'users.last_name', 'users.profile_picture')
            ->orderBy('posts.updated_at', 'desc')
            ->get();
            return response($post, 200);
        } else {
            return response()->json([
                "message" => "Post not found"
            ], 404);
        }
    }
}