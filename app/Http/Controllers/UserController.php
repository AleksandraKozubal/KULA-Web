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

    public function show(User $user)
    {
        return json_encode($user);
    }

    public function edit(Request $request, User $user)
    {
        $user->name ? $user->name = $request->name : null;
        $user->email ? $user->email = $request->email : null;
        $user->password ? $user->password = $request->password : null;
        $user->save();
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}
