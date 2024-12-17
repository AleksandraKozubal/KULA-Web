<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(User::all());
    }
    /**
     * @param UserRequest $request
     */
    public function register(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = "admin";
        $user->password = bcrypt($request->password);
        $user->save();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();

        $token->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }


    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
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

    /**
     * @return JsonResponse
     */
    public function show()
    {
        return response()->json(auth()->user());
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
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


    /**
     * @return void
     */
    public function destroy()
    {
        User::find(auth()->id())->delete();
    }
}
