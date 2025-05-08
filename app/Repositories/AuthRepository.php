<?php

namespace App\Repositories\Auth;

use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function attemptLogin(array $credentials)
    {
        return Auth::attempt($credentials);
    }
}
