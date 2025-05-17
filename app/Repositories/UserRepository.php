<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        if (isset($data['avatar']) && $data['avatar'] instanceof \Illuminate\Http\UploadedFile) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $data['avatar']->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->name = $data['name'] ?? $user->name;
        $user->email = $data['email'] ?? $user->email;
        $user->class_id = $data['class_id'] ?? $user->class_id;

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

    //Lấy danh sách học sinh theo lớp
    public function getStudentsByClass(int $classId)
    {
        return User::where('role', 'student')
                   ->where('class_id', $classId)
                   ->get();
    }
}
