<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string|unique:users,username|max:30',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'nullable|string|max:8'
        ]);

        $user = User::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'role' => 'customer',
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'nullable|string',
            'username' => 'nullable|string',
            'password' => 'required|string'
        ]);

        $user = null;

        // Check user exist
        if($request->email) {
            $user = User::where('email', $fields['email'])->first();
        }elseif($request->username) {
            $user = User::where('username', $fields['username'])->first();
        }

        //Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'unauthorized'
            ], 401);

        }

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
