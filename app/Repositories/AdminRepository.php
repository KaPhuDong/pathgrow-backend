<?php

namespace App\Repositories;

use App\Models\User;

class AdminRepository
{
    public function getAllUsers()
    {
        return User::whereIn('role', ['teacher', 'student'])
        ->orderBy('id', 'desc')
        ->get();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }
    public function getUsersByRoles(array $roles)
    {
        return User::whereIn('role', $roles)
        ->orderBy('id', 'desc')
        ->get();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}
