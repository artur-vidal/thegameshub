<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $data = $request->validated();

        if(!Auth::attempt($data)) {
            return back()->withErrors('Credenciais inválidas.');
        }

        return view('admin.home');
    }

    public function logout() {
        Auth::logout();
        return view('auth.login');
    }
}
