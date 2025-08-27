<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return redirect()->route('admin.login');
        }

        $user = auth()->user();

        // Check if user has any of the required roles
        if (!$user->hasAnyRole($roles)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Access denied. Insufficient role privileges.'], 403);
            }
            abort(403, 'Access denied. Insufficient role privileges.');
        }

        return $next($request);
    }
}
