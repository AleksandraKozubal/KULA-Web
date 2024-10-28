<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return json_encode(User::all());
    }
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
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
