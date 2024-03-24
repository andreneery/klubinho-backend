<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Likes;
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
        if(Post::where('user_id', $id)->exists()) {
            $post = Post::where('user_id', $id)
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name', 'users.last_name', 'users.imagem')
            ->orderBy('posts.updated_at', 'desc')
            ->get();
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
            ->select('posts.*', 'users.name', 'users.last_name', 'users.imagem')
            ->orderBy('posts.updated_at', 'desc')
            ->get();
            return response($post, 200);
        } else {
            return response()->json([
                "message" => "Post not found"
            ], 404);
        }
    }

    // likes

    public function likePost($id)
    {
        $user = Auth::user();
        $post = Likes::find($id);
        $like = $post->likes()->where('user_id', $user->id)->first();
        if($like) {
            $like->delete();
            return response()->json([
                "message" => "Like removed"
            ], 202);
        } else {
            $post->likes()->create([
                'user_id' => $user->id,
                'liked' => true
            ]);
            return response()->json([
                "message" => "Like added"
            ], 201);
        }
    }

    //get all users liked a post
    public function getUsersLiked($id)
    {
        $post = Likes::find($post_id);
        $users = $post->likes()->where('liked', true)
        ->join('users', 'likes.user_id', '=', 'users.id')
        ->select('users.*')
        ->get();
        return response($users, 200);
    }

    //count likes in a post
    public function countLikes($id)
    {
        $post = Likes::find($post_id);
        $likes = $post->likes()->where('liked', true)->count();
        return response()->json([
            "likes" => $likes
        ], 200);
    }
}