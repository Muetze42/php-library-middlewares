<?php

namespace NormanHuth\Library\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LogUserActivityMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($user = $request->user()) {
            DB::table('users')
                ->where('id', $user->getKey())
                ->update(['active_at' => now()]);
        }

        return $next($request);
    }
}
