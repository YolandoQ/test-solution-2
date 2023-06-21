<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAPIToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $apiToken = $request->header('api-token');

        if ($apiToken !== env('APP_HASH_AUTH')) {
            return response()->json([
                "success" => false,
                'message' => 'Aplicação não autorizada',
                "data" => []
            ], 401);
        }

        return $next($request);
    }
}
