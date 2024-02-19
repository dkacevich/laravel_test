<?php

namespace App\Http\Middleware;

use App\Models\AccessToken;
use Closure;
use Illuminate\Http\Request;

class ValidAccessTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Token');

        $accessToken = AccessToken::where('payload', $token)->first();

        if (!$accessToken || $accessToken->created_at->subMinutes(40) > now()) {
            return response()->json([
                'success' => false,
                'message' => 'The token expired.'
            ], 401);
        }

        $accessToken->delete();

        return $next($request);
    }
}
