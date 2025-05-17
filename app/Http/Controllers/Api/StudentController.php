<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    // Lấy thông tin profile user hiện tại
    public function getProfile()
    {
        return response()->json(Auth::user());
    }

    // Cập nhật profile (tên, email, avatar, class_id)
    public function updateProfile(Request $request)
    {
        $userId = Auth::id(); 

        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $userId,
            'class_id' => 'nullable|integer|exists:classes,id',
            'avatar' => 'nullable|image|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['name', 'email', 'class_id']);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar');
        }

        $updatedUser = $this->userRepo->updateProfile($userId, $data);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $updatedUser,
        ]);
    }

    // Đổi mật khẩu
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
