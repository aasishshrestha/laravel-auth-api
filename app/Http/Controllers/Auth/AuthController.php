<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response([
            "user" => $user,
            "message" => "Successfully created"
        ]);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            $user->api_token = Str::random(60);
            // $user->api_token = $user->generateToken();
            $user->save();
            // DB::table('users')->where('id', $user->id)->update(['api_token' => $user->api_token]);

            return $user;
        }

        return response()->json(['message' => 'Something went wrong'], 401);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($user) {

            $user->api_token = null;
            $user->save();
            // DB::table('users')->where('id', $user->id)->update(['api_token' => null]);

        }

        return response()->json(['message' => 'You are successfully logged out'], 200);
    }
}
