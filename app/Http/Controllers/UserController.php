<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(User::all());
    }

    public function register(UserRequest $request): JsonResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = "admin";
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(["message" => "User created successfully", "user" => $user]);
    }

    public function login(Request $request): JsonResponse
    {
        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "message" => "Unauthorized",
            ], 401);
        }
        $token = $user->createToken("token")->plainTextToken;

        return response()->json([
            "token" => $token,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $token = $request->user()->currentAccessToken();

        $token->delete();

        return response()->json(["message" => "Successfully logged out"]);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            "message" => "Created an account",
            "user" => $user,
            "token" => $user->createToken("token")->plainTextToken,
        ], 201);
    }

    public function show(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function edit(UserRequest $request): JsonResponse
    {
        $user = User::find(auth()->id());

        if ($request->filled("name")) {
            $user->name = $request->input("name");
        }

        if ($request->filled("email")) {
            $user->email = $request->input("email");
        }

        if ($request->filled("password")) {
            $user->password = bcrypt($request->input("password"));
        }

        $user->save();

        return response()->json("Zaktualizowano dane", 200);
    }

    public function destroy(): JsonResponse
    {
        User::find(auth()->id())->delete();

        return response()->json("Usunięto konto", 200);
    }
}
