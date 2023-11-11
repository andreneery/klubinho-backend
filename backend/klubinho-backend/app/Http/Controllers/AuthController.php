<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            "message" => "User record created"
        ], 201);
    }

    public function login(request $request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = User::where('email', $credentials['email'])->first();
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function getUser($id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($user, 200);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    public function logout()
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
    
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function getAccessToken(Request $request)
    {
        $token = $request->user()->createToken($request->token_name);
        return response()->json(['token' => $token->plainTextToken]);
    }

    //get user id by token
    public function getUserIdByToken(Request $request)
    {
        $user = $request->user();
        return response()->json(['user_id' => $user->id]);
    }

    // update user profile picture
    public function updateProfilePicture(Request $request)
    {
        $user = User::find($request->email);
        $user->profile_picture = $request->profile_picture;
        $user->save();
        return response()->json([
            "message" => "User profile picture updated"
        ], 201);
    }

    // update user data
    public function updateUserData(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->birthday_date = $request->birthday_date;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->save();
        return response()->json([
            "message" => "User data updated"
        ], 201);
    }
}
