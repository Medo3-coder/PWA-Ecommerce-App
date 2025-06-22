<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (! auth()->check()) {
            return redirect()->route('login');
        }
        // Check if user has admin role (you can customize this based on your user roles system)
        if (! auth()->user()->is_admin) {
            abort(403, 'Access denied. Admin privileges required.');
        }
        return $next($request);
    }
}
