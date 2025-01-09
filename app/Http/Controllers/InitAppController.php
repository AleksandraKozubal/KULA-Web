<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class InitAppController extends Controller
{
    public function index(): View
    {
        if (User::where("role", "admin")->exists()) {
            return redirect("/");
        }

        return view("init-app");
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $user = $this->createOrFindUser($request);

        auth()->login($user);

        return redirect("/");
    }

    public function createOrFindUser(UserRequest $request): User
    {
        return User::firstOrCreate(
            ["email" => $request->email],
            [
                "role" => Role::Admin,
                "name" => $request->name,
                "email_verified_at" => now(),
                "password" => Hash::make($request->password),
                "remember_token" => Str::random(10),
                "active" => true,
            ],
        );
    }
}
