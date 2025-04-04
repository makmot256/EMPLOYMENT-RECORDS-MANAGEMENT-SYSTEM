<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // Explode roles if passed as comma-separated string
        if (count($roles) === 1 && str_contains($roles[0], ',')) {
            $roles = explode(',', $roles[0]);
        }

        $roles = array_map('trim', $roles); // Clean whitespace

        if (!$user || !in_array($user->role, $roles)) {
            return response()->json(['message' => 'Forbidden: Insufficient permissions'], 403);
        }

        return $next($request);
    }
}
