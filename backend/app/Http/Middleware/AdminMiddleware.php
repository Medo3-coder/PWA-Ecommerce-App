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
         if (!auth()->check()) {
             // Redirect to admin login page
             return redirect()->route('admin.login');
         }
         // Check if user has admin role
         if (!auth()->user()->hasAnyRole(['super_admin', 'admin'])) {
             abort(403, 'Access denied. Admin privileges required.');
         }
         return $next($request);
     }
}


