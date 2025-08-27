<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return redirect()->route('admin.login');
        }

        $user = auth()->user();

        // Check if user has any of the required permissions
        if (!$user->hasAnyPermission($permissions)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Access denied. Insufficient permissions.'], 403);
            }
            abort(403, 'Access denied. Insufficient permissions.');
        }

        return $next($request);
    }
}

