<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\Role;
use App\Http\Requests\UserRequest;
use \Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InitAppController extends Controller
{
    /**
     * @return RedirectResponse|View
     */
    public function index()
    {
        if (User::where('role', 'admin')->exists()) {
            return redirect('/');
        }

        return view('init-app');
    }

    /**
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = $this->createOrFindUser($request);

        auth()->login($user);

        return redirect('/');
    }

    /**
     * @param UserRequest $request
     * @return User
     */
    public function createOrFindUser(UserRequest $request)
    {
        return User::firstOrCreate(
            ["email" => $request->email],
            [
                "role" => Role::Admin,
                "name" => $request->name,
                "email_verified_at" => now(),
                "password" => Hash::make($request->password),
                "remember_token" => Str::random(10),
                "active" => true
            ]
        );
    }
}
