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

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function updateProfile(int $id, array $data): ?User
    {
        $user = $this->findById($id);
        if (!$user) {
            return null;
        }

        $user->name = $data['name'] ?? $user->name;
        $user->email = $data['email'] ?? $user->email;
        $user->class_id = $data['class_id'] ?? $user->class_id;

        if (isset($data['avatar']) && is_string($data['avatar'])) {
            $user->avatar = $data['avatar'];
            $user->avatar_public_id = $data['avatar_public_id'] ?? null;
        }

        $user->save();

        return $user;
    }

    public function changePassword(int $id, string $currentPassword, string $newPassword): bool
    {
        $user = $this->findById($id);
        if (!$user || !Hash::check($currentPassword, $user->password)) {
            return false;
        }

        $user->password = Hash::make($newPassword);
        return $user->save();
    }

    public function getStudentsByClass(int $classId)
    {
        return User::where('role', 'student')
                   ->where('class_id', $classId)
                   ->get();
    }
}
