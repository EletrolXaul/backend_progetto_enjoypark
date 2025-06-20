<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ParkApiMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Aggiungi headers per CORS se necessario
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return $response;
    }
}
