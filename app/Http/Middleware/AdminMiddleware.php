<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isAdmin) {
            return response()->json([
                'error' => 'Accesso negato. Solo gli amministratori possono accedere a questa risorsa.'
            ], 403);
        }

        return $next($request);
    }
}