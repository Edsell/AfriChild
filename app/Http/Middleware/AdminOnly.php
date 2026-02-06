<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || strtolower(trim((string) $user->role)) !== 'admin') {
            abort(403, 'This action is unauthorized.');
        }

        return $next($request);
    }
}
