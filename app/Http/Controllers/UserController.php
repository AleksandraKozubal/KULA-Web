<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return json_encode(User::all());
    }
    public function register(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = "admin";
        $user->password = bcrypt($request->password);
        $user->save();
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        // Get the token instance
        $token = $request->user()->currentAccessToken();

        // Delete the token
        $token->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'message' => 'Created an account',
            'user' => $user,
            'token' => $user->createToken('token')->plainTextToken
        ], 201);
    }

    public function show()
    {
        return json_encode(auth()->user());
    }

    public function edit(UserRequest $request)
    {
        $user = User::find(auth()->id());

        if ($request->filled('name')) {
            $user->name = $request->input('name');
        }

        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password')); 
        }

        $user->save();

        return response()->json(['message' => 'User information updated successfully', 'user' => $user]);
    }


    public function destroy()
    {
        User::find(auth()->id())->delete();
    }
}
