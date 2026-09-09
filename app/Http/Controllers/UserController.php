<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(UserStoreRequest $request) {
        $data = $request->validated();
        $user = User::create($data);
        return redirect('/login');
    }
}
