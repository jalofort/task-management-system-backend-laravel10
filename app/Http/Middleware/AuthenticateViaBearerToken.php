<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateViaBearerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->bearerToken()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check if the bearer token is valid and retrieve the authenticated user
        $user = User::select('id')->where('access_token', $request->bearerToken())->first();

        if (!$user)
            return response()->json(['error' => 'Unauthorized'], 401);

        // Store the authenticated user ID in the request object for future use
        $request->merge(['userID' => $user['id']]);

        return $next($request);
    }
}
