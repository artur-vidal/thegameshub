<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $data = $request->validated();
        $loginFieldName = filter_var($data['login-field'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginFieldName => $data['login-field'],
            'password' => $data['password']
        ];

        if(!Auth::attempt($credentials)) {
            return back()->withErrors('Credenciais inválidas.');
        }

        return redirect('/admin');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
