<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $adminRepo;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function index(Request $request)
    {
        $roleFilter = ['teacher', 'student'];
        return response()->json(
            $this->adminRepo->getUsersByRoles($roleFilter)
        );
    }

    public function show($id)
    {
        return response()->json($this->adminRepo->getUserById($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,teacher,student',
            'class_id' => 'nullable|integer|exists:classes,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = $this->adminRepo->createUser($validated);
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:100',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'role' => 'sometimes|in:admin,teacher,student',
            'class_id' => 'nullable|integer|exists:classes,id',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user = $this->adminRepo->updateUser($id, $validated);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $this->adminRepo->deleteUser($id);
        return response()->json(['message' => 'User deleted successfully']);
    }
}
