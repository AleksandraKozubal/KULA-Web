<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\Role;

class InitAppController extends Controller
{
    public function index()
    {
        if (DB::table('users')->count() > 0) {
            return redirect('/');
        }

        return view('init-app');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

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
