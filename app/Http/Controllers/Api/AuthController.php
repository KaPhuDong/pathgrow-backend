<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use Illuminate\Http\Request;
use App\Services\AuthServiceInterface;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
=======
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
>>>>>>> ec2cea1b59ba16df5998e323b62b032c2e0d41d6
    }

    public function login(Request $request)
    {
<<<<<<< HEAD
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'required|string',
        ]);

        return $this->authService->login($request);
=======
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $this->users->findByEmail($request->email);

        if (!$user || !$this->users->checkCredentials($user, $request->password)) {
            return response()->json(['message' => 'Email or password is incorrect.'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token'   => $token,
            'role'    => $user->role,
            'user'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
                'avatar' => $user->avatar,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful']);
>>>>>>> ec2cea1b59ba16df5998e323b62b032c2e0d41d6
    }
}
