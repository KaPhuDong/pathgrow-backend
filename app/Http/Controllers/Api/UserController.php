<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Hàm lấy user theo role (ví dụ: teacher)
    public function index(string $role)
    {
        $users = $this->userService->getUsersByRole($role);

        return response()->json($users);
    }
}
