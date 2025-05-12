<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\AuthRepositoryInterface;

class AuthService implements AuthServiceInterface
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request)
    {
        $user = $this->authRepository->findUserByEmailAndRole($request->email, $request->role);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials or role'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'user'    => $user
        ]);
    }
}
