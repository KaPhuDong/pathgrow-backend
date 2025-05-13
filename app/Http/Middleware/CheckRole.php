<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        // Nếu chưa đăng nhập
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Nếu không đúng vai trò
        if ($user->role !== $role) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
