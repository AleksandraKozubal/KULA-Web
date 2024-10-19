<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
            'password' => bcrypt($request->password),
        ]);

        auth()->login($user);

        return redirect('/');
    }
}
