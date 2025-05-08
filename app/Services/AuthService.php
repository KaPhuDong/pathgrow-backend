<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $authRepo;

    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function login(array $credentials)
    {
        if ($this->authRepo->attemptLogin($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token
            ];
        }

        return false;
    }
}
