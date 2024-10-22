<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\Role;
use App\Http\Requests\UserRequest;

class InitAppController extends Controller
{
    public function index()
    {
        if (User::count() > 0) {
            return redirect('/');
        }

        return view('init-app');
    }

    public function store(Request $request)
    {
        $userRequest = new UserRequest();
        $request->validate($userRequest->rules());

        $user = User::firstOrCreate(
            ["email" => "$request->email"],
            ["role" => Role::Admin,
                "name" => "$request->name",
                "email_verified_at" => now(),
                "password" => Hash::make($request->password),
                "remember_token" => Str::random(10),
                "active" => true,
            ],
        );

        auth()->login($user);

        return redirect('/');
    }
}
