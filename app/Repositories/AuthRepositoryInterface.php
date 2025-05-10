<?php

namespace App\Repositories\Auth;

interface AuthRepositoryInterface
{
    public function attemptLogin(array $credentials);
}
