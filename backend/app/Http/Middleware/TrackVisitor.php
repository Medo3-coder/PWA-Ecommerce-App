<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {

        $startTime = now();

        // Capture visitor information
        $visitorData = [
            'ip'         => $request->ip(),
            'url'        => $request->fullUrl(),
            'referrer'   => $request->header('referer'),
            'agent'      => $request->headers('User-Agent'),
            'visited_at' => now(),
        ];

        $visitor = Visitor::create($visitorData);

        Log::info('Visitor tracked', $visitorData);

        // Process the request and store the response
        $reponse = $next($request);

        // Calculate visited time by tracking exit time
        $endTime     = now();
        $visitedTime = $endTime->diffInSeconds($startTime);

        $visitor->update(['visited_time' => $visitedTime]);

        return $reponse;
    }
}
