<?php

namespace App\Repositories;

interface AuthRepositoryInterface
{
    public function findUserByEmailAndRole(string $email, string $role);
}

