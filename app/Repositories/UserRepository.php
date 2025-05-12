<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function checkCredentials(User $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }
}
