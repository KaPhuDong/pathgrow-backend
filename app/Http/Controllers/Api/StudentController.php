<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class StudentController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getProfile()
    {
        $user = Auth::user()->load('class');

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar ?? 'https://uuc.edu.vn/uploads/2025/04/16/67fecff2bdd55.webp',
            'avatar_public_id' => $user->avatar_public_id,
            'class' => $user->class ? $user->class->name : null,
            'class_id' => $user->class_id,
            'role' => $user->role,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $userId = Auth::id();

        $rules = [
            'name' => 'required|string|max:100',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['name']);

        if ($request->hasFile('avatar')) {
            $user = Auth::user();

            try {
                if ($user->avatar_public_id) {
                    Cloudinary::uploadApi()->destroy($user->avatar_public_id);
                }

                $uploadResult = Cloudinary::uploadApi()->upload(
                    $request->file('avatar')->getRealPath(),
                    [
                        'folder' => 'avatars',
                        'public_id' => 'avatar_' . $userId . '_' . time(),
                        'transformation' => [
                            'quality' => 'auto:eco',
                            'fetch_format' => 'auto',
                            'width' => 200,
                            'height' => 200,
                            'crop' => 'fill',
                        ]
                    ]
                );

                $data['avatar'] = $uploadResult['secure_url'];
                $data['avatar_public_id'] = $uploadResult['public_id'];
            } catch (\Exception $e) {
                return response()->json(['error' => 'Không thể tải ảnh lên Cloudinary: ' . $e->getMessage()], 500);
            }
        }

        try {
            $updatedUser = $this->userRepo->updateProfile($userId, $data);
            if (!$updatedUser) {
                return response()->json(['error' => 'User not found'], 404);
            }

            return response()->json([
                'message' => 'Profile updated successfully',
                'user' => [
                    'id' => $updatedUser->id,
                    'name' => $updatedUser->name,
                    'email' => $updatedUser->email,
                    'avatar' => $updatedUser->avatar ?? 'https://uuc.edu.vn/uploads/2025/04/16/67fecff2bdd55.webp',
                    'avatar_public_id' => $updatedUser->avatar_public_id,
                    'class_id' => $updatedUser->class_id,
                    'role' => $updatedUser->role,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update profile: ' . $e->getMessage()], 500);
        }
    }

    //Change Password
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $changed = $this->userRepo->changePassword(
            $user->id,
            $request->current_password,
            $request->new_password
        );

        if (!$changed) {
            return response()->json(['error' => 'Current password is incorrect'], 400);
        }

        return response()->json(['message' => 'Password changed successfully']);
    }
}
