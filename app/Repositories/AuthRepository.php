<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    public function findUserByEmailAndRole(string $email, string $role)
    {
        return User::where('email', $email)->where('role', $role)->first();
    }
}
